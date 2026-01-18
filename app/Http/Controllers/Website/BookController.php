<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Website\Pay\IPayService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('website.book.index');
    }

    public function checkout(Book $book, IPayService $payService)
    {
        $result = $payService->checkoutBook($book->id);

        if (!($result['status'] ?? false)) {
            return back()->with('error', $result['message'] ?? 'حدث خطأ أثناء إنشاء رابط الدفع');
        }

        return redirect()->away($result['url']);
    }

    public function success(Request $request, IPayService $payService)
    {
        $result = $payService->handleSuccess($request);

        if (!($result['status'] ?? false)) {
            return redirect()->route('checkout.failed');
        }

        return view('website.checkout.success', $result);
    }

    public function failed(Request $request, IPayService $payService)
    {
        $result = $payService->handleFailed($request);

        return view('website.checkout.failed', $result);
    }
}
