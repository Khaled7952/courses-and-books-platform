<?php

namespace App\Services\Website\CartManager;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartManager implements ICartManager
{
    protected int $cookieMinutes = 60 * 24 * 10;

    public function addCourse(int $courseId): void
    {
        $course = Course::select('id', 'title', 'price', 'image')->find($courseId);

        if (!$course) {
            return;
        }

        $cart = $this->getCart();

        if (!isset($cart['items'][$course->id])) {
            $cart['items'][$course->id] = [
                'id' => $course->id,
                'title' => $course->title,
                'price' => $course->price,
                'image' => $course->image,
            ];

            $this->storeCart($cart);
        }
    }

    public function removeCourse(int $courseId): void
    {
        $cart = $this->getCart();

        if (isset($cart['items'][$courseId])) {
            unset($cart['items'][$courseId]);
            $this->storeCart($cart);
        }
    }

    public function getCart(): array
    {
        $key = $this->getCartKey();

        return Cache::get($key, [
            'items' => [],
        ]);
    }

    public function getCount(): int
    {
        $cart = $this->getCart();
        return isset($cart['items']) ? count($cart['items']) : 0;
    }

    protected function storeCart(array $cart): void
    {
        $key = $this->getCartKey();

        Cache::put($key, $cart, now()->addDays(10));
    }

    protected function getCartKey(): string
    {
        $token = Cookie::get('cart_token');

        if (!$token) {
            $token = Str::uuid()->toString();
            Cookie::queue('cart_token', $token, $this->cookieMinutes);
        }

        return 'cart_' . $token;
    }
}
