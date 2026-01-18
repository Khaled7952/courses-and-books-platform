<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CourseRating;
use App\Services\Website\CartManager\ICartManager;
use App\Services\Website\Courses\ICoursesWebService;
use App\Services\Website\Pay\IPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class CoursesWebController extends Controller
{
    protected ICoursesWebService $coursesService;

    public function __construct(ICoursesWebService $coursesService)
    {
        $this->coursesService = $coursesService;
    }

    public function index()
    {
        $courses = $this->coursesService->getCoursesPaginated(12);

        return view('website.courses.index', compact('courses'));
    }

   public function course(string $slug)
{
    $course = $this->coursesService->getCourseBySlug($slug);

    $reviews = CourseRating::query()
        ->where('course_id', $course->id)
        ->whereNotNull('comment')
        ->where('comment', '!=', '')
        ->with(['customer:id,name'])
        ->latest()
        ->get(['id', 'course_id', 'customer_id', 'rating', 'comment', 'created_at']);

    return view('website.courses.course', compact('course', 'reviews'));
}

    public function checkout(Request $request, IPayService $payService, ICartManager $cartManager)
    {
        $cart = $cartManager->getCart();
        $courseIds = array_keys($cart['items'] ?? []);

        $result = $payService->checkoutCourses($courseIds);

        if (!($result['status'] ?? false)) {
            return back()->with('error', $result['message'] ?? 'حدث خطأ أثناء إنشاء رابط الدفع');
        }

        return redirect()->away($result['url']);
    }

    public function success(Request $request, IPayService $payService)
    {
        $result = $payService->handleSuccess($request);

        if (!($result['status'] ?? false)) {
            return redirect()->route('courses.checkout.failed');
        }

        $token = Cookie::get('cart_token');

if ($token) {
    Cache::forget('cart_' . $token);
}


        return view('website.courses.checkout.success', $result);
    }

    public function failed(Request $request, IPayService $payService)
    {
        $result = $payService->handleFailed($request);

        return view('website.courses.checkout.failed', $result);
    }

}
