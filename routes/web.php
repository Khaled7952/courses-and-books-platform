<?php

use App\Http\Controllers\Website\BlogWebController;
use App\Http\Controllers\Website\BookController;
use App\Http\Controllers\Website\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\FormController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\CoursesWebController;
use App\Http\Controllers\Website\CustomerAuthController;
use App\Http\Controllers\Website\FaqWebController;
use App\Http\Controllers\Website\MenuController;
use App\Http\Controllers\Website\PackageController;
use App\Http\Controllers\Website\ProfileController;

Route::group(
    [
        'prefix' => '/',
    ],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/packages/{id}/details', [HomeController::class, 'packageDetails'])->name('packages.details');
        Route::get('/meals/filter', [HomeController::class, 'filterMeals'])->name('meals.filter');

        Route::get('/faq', [FaqWebController::class, 'index'])->name('faq.index');
        Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact.index');
        Route::post('/form', [FormController::class, 'store'])->name('form.store');
        Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/load', [MenuController::class, 'load'])->name('menu.load');

        Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');

        Route::view('/privacy-policy', 'website.privacy_policy')->name('privacy.policy');

        Route::get('/business', [ContactUsController::class, 'index'])->name('business.index');

        ######################## Cart #########################################
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

        Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

        Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

        ######################## Auth - Register #########################

        Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register.show');

        Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register.store');

        Route::get('/verify', [CustomerAuthController::class, 'showVerifyForm'])->name('customer.verify.show');

        Route::post('/verify', [CustomerAuthController::class, 'verifyOtp'])->name('customer.verify.check');

        ######################## Book #########################

        Route::get('/book', [BookController::class, 'index'])->name('book.index');
       Route::post('/book/{book}/checkout', [BookController::class, 'checkout'])
    ->middleware('auth:customer')
    ->name('book.checkout');

        Route::get('/checkout/success', [BookController::class, 'success'])->name('checkout.success');

        Route::get('/checkout/failed', [BookController::class, 'failed'])->name('checkout.failed');

        ############################ Courses ############################

        Route::get('/courses', [CoursesWebController::class, 'index'])->name('courses.index');
        Route::get('/courses/{slug}', [CoursesWebController::class, 'course'])->name('courses.course');

        Route::post('/courses/checkout', [CoursesWebController::class, 'checkout'])
    ->middleware('auth:customer')
    ->name('courses.checkout');

Route::get('/courses/checkout/success', [CoursesWebController::class, 'success'])
    ->name('courses.checkout.success');

Route::get('/courses/checkout/failed', [CoursesWebController::class, 'failed'])
    ->name('courses.checkout.failed');

    ############################ Blog ############################

Route::get('/blog', [BlogWebController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/{slug}', [BlogWebController::class, 'show'])
    ->name('blog.show');

    Route::get('/category/{id}', [BlogWebController::class, 'category'])
    ->name('blog.category.show');

        ######################## Auth - Register #########################
        Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login.show');
        Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login.store');

        ############################ Profile ################################
        Route::group(['middleware' => 'auth:customer'], function () {
            Route::controller(ProfileController::class)->group(function () {
                Route::get('profile', 'index')->name('profile');
                Route::post('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
                Route::post('profile/book/{book}/rate', 'rateBook')->name('profile.book.rate');
                Route::post('profile/course/{course}/rate', 'rateCourse')->name('profile.course.rate');
            });
        });
    },
);
