<?php

namespace App\Services\Website\Pay;

use App\Models\Book;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PayService implements IPayService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $integrationId;
    protected string $iframeId;
    protected string $hmacSecret;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('paymob.base_url'), '/');
        $this->apiKey = config('paymob.api_key');
        $this->integrationId = (string) config('paymob.integration_id');
        $this->iframeId = (string) config('paymob.iframe_id');
        $this->hmacSecret = (string) config('paymob.hmac');
    }

    public function checkoutBook(int $bookId): array
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return ['status' => false, 'message' => 'Unauthorized'];
        }

        $book = Book::findOrFail($bookId);

        return DB::transaction(function () use ($customer, $book) {
            $order = Order::create([
                'user_id' => $customer->id,
                'order_code' => $this->generateOrderCode(),
                'order_type' => 'book',
                'total_price' => $book->price,
                'status' => 'pending',
                'name' => $customer->name ?? 'Customer',
                'phone' => $customer->mobile ?? null,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $book->id,
                'item_type' => Book::class,
                'item_name' => $book->title ?? 'Book',
                'price' => $book->price,
                'status' => 'completed',
            ]);

            $paymentUrl = $this->createPaymobPaymentUrl($order, $customer);

            if (!$paymentUrl['status']) {
                return $paymentUrl;
            }

            return [
                'status' => true,
                'url' => $paymentUrl['url'],
                'order_id' => $order->id,
                'order_code' => $order->order_code,
            ];
        });
    }

    public function checkoutCourses(array $courseIds): array
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return ['status' => false, 'message' => 'Unauthorized'];
        }

        $courseIds = array_values(array_filter($courseIds));
        if (empty($courseIds)) {
            return ['status' => false, 'message' => 'No courses selected'];
        }

        $courses = Course::whereIn('id', $courseIds)->get();
        if ($courses->count() === 0) {
            return ['status' => false, 'message' => 'Courses not found'];
        }

        $total = (float) $courses->sum('price');

        return DB::transaction(function () use ($customer, $courses, $total) {
            $order = Order::create([
                'user_id' => $customer->id,
                'order_code' => $this->generateOrderCode(),
                'order_type' => 'course',
                'total_price' => $total,
                'status' => 'pending',
                'name' => $customer->name ?? 'Customer',
                'phone' => $customer->mobile ?? null,
            ]);

            foreach ($courses as $course) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $course->id,
                    'item_type' => Course::class,
                    'item_name' => $course->title ?? 'Course',
                    'price' => $course->price,
                    'status' => 'completed',
                ]);
            }

            $paymentUrl = $this->createPaymobPaymentUrl($order, $customer);

            if (!$paymentUrl['status']) {
                return $paymentUrl;
            }

            return [
                'status' => true,
                'url' => $paymentUrl['url'],
                'order_id' => $order->id,
                'order_code' => $order->order_code,
            ];
        });
    }

    public function handleSuccess(Request $request): array
    {
        $payload = $request->all();

        $valid = $this->verifyPaymobHmac($payload);

        if (!$valid) {
            return ['status' => false, 'message' => 'Invalid HMAC'];
        }

        $success = ($payload['success'] ?? 'false') === 'true';
        if (!$success) {
            return ['status' => false, 'message' => 'Payment not successful'];
        }

        $merchantOrderId = $payload['merchant_order_id'] ?? null;

        if (!$merchantOrderId) {
            return ['status' => false, 'message' => 'Missing merchant_order_id'];
        }

        $order = Order::where('order_code', $merchantOrderId)->first();
        if (!$order) {
            return ['status' => false, 'message' => 'Order not found'];
        }

        if ($order->status !== 'paid') {
            $order->update(['status' => 'paid']);
        }

        return [
            'status' => true,
            'message' => 'Payment successful',
            'order' => $order->load('items'),
        ];
    }

    public function handleFailed(Request $request): array
    {
        $payload = $request->all();

        $valid = $this->verifyPaymobHmac($payload);

        if (!$valid) {
            return ['status' => false, 'message' => 'Invalid HMAC'];
        }

        $merchantOrderId = $payload['merchant_order_id'] ?? null;

        if (!$merchantOrderId) {
            return ['status' => false, 'message' => 'Missing merchant_order_id'];
        }

        $order = Order::where('order_code', $merchantOrderId)->first();
        if (!$order) {
            return ['status' => false, 'message' => 'Order not found'];
        }

        if ($order->status !== 'failed') {
            $order->update(['status' => 'failed']);
        }

        return [
            'status' => true,
            'message' => 'Payment failed',
            'order' => $order->load('items'),
        ];
    }

    public function verifyPaymobHmac(array $payload): bool
    {
        if (empty($this->hmacSecret)) {
            Log::warning('[PAYMOB] Missing HMAC secret');
            return false;
        }

        $fields = ['amount_cents', 'created_at', 'currency', 'error_occured', 'has_parent_transaction', 'id', 'integration_id', 'is_3d_secure', 'is_auth', 'is_capture', 'is_refunded', 'is_standalone_payment', 'is_voided', 'order', 'owner', 'pending', 'source_data_pan', 'source_data_sub_type', 'source_data_type', 'success'];

        $concatenated = '';
        foreach ($fields as $field) {
            $concatenated .= $payload[$field] ?? '';
        }

        $calculatedHmac = hash_hmac('sha512', $concatenated, $this->hmacSecret);
        $received = $payload['hmac'] ?? '';

        return hash_equals($calculatedHmac, $received);
    }

    protected function authenticate(): string
    {
        $response = Http::post("{$this->baseUrl}/api/auth/tokens", [
            'api_key' => $this->apiKey,
        ]);

        if (!$response->successful()) {
            Log::error('[PAYMOB] Auth failed', ['body' => $response->body()]);
            throw new \Exception('Authentication with Paymob failed.');
        }

        return $response->json('token');
    }

    protected function createPaymobOrder(string $authToken, Order $order, array $customerData): int
    {
        $response = Http::withToken($authToken)->post("{$this->baseUrl}/api/ecommerce/orders", [
            'merchant_order_id' => $order->order_code,
            'amount_cents' => (int) round($order->total_price * 100),
            'currency' => 'SAR',
            'delivery_needed' => false,
            'items' => [],
            'shipping_data' => [
                'email' => $customerData['email'] ?? 'N/A',
                'first_name' => $customerData['first_name'] ?? 'Customer',
                'last_name' => $customerData['last_name'] ?? 'User',
                'phone_number' => $customerData['mobile'] ?? '0000000000',
                'street' => $customerData['street'] ?? 'N/A',
                'city' => $customerData['city'] ?? 'Riyadh',
                'country' => $customerData['country'] ?? 'Saudi Arabia',
                'state' => $customerData['state'] ?? 'Riyadh',
            ],
        ]);

        if (!$response->successful()) {
            Log::error('[PAYMOB] Create order failed', ['body' => $response->body()]);
            throw new \Exception('Creating order in Paymob failed.');
        }

        return (int) $response->json('id');
    }

    protected function generatePaymentKey(string $authToken, int $paymobOrderId, Order $order, array $customerData): string
    {
        $redirectUrl = $order->order_type === 'course'
            ? route('courses.checkout.success')
            : route('checkout.success');

        $errorUrl = $order->order_type === 'course'
            ? route('courses.checkout.failed')
            : route('checkout.failed');

        $response = Http::withToken($authToken)->post("{$this->baseUrl}/api/acceptance/payment_keys", [
            'amount_cents' => (int) round($order->total_price * 100),
            'currency' => 'SAR',
            'order_id' => $paymobOrderId,
            'integration_id' => (int) $this->integrationId,
            'billing_data' => [
                'email' => $customerData['email'] ?? 'N/A',
                'first_name' => $customerData['first_name'] ?? 'Customer',
                'last_name' => $customerData['last_name'] ?? 'User',
                'phone_number' => $customerData['mobile'] ?? '0000000000',
                'apartment' => 'N/A',
                'floor' => 'N/A',
                'street' => $customerData['street'] ?? 'N/A',
                'building' => 'N/A',
                'city' => $customerData['city'] ?? 'Riyadh',
                'country' => $customerData['country'] ?? 'Saudi Arabia',
                'state' => $customerData['state'] ?? 'Riyadh',
            ],
            'redirect_url' => $redirectUrl,
            'error_url' => $errorUrl,
        ]);

        if (!$response->successful()) {
            Log::error('[PAYMOB] Generate key failed', ['body' => $response->body()]);
            throw new \Exception('Generating payment key failed.');
        }

        return (string) $response->json('token');
    }

    protected function createPaymobPaymentUrl(Order $order, $customer): array
    {
        try {
            $customerData = [
                'email' => $customer->email ?? 'N/A',
                'first_name' => Str::of($customer->name ?? 'Customer')->explode(' ')->first(),
                'last_name' => 'User',
                'phone' => $customer->mobile ?? '0000000000',
                'street' => 'N/A',
                'city' => 'Riyadh',
                'country' => 'Saudi Arabia',
                'state' => 'Riyadh',
            ];

            $authToken = $this->authenticate();
            $paymobOrderId = $this->createPaymobOrder($authToken, $order, $customerData);
            $paymentKey = $this->generatePaymentKey($authToken, $paymobOrderId, $order, $customerData);

            $iframeUrl = "{$this->baseUrl}/api/acceptance/iframes/{$this->iframeId}?payment_token={$paymentKey}";

            return ['status' => true, 'url' => $iframeUrl];
        } catch (\Exception $e) {
            Log::error('[PAYMOB] Payment url error', [
                'order_id' => $order->id,
                'message' => $e->getMessage(),
            ]);

            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    protected function generateOrderCode(): string
    {
        $base = now()->format('ymdHi');
        $rand = str_pad((string) random_int(0, 99), 2, '0', STR_PAD_LEFT);

        return "ORD-{$base}-{$rand}";
    }
}
