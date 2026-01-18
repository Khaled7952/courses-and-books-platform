<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CodeSnippetController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\CustomersController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\RolesAndManagers\ManagerController;
use App\Http\Controllers\Dashboard\RolesAndManagers\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\MessagesController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\Dashboard\FaqDetailController;
use App\Http\Controllers\Dashboard\FeaturesAndWorksController;
use App\Http\Controllers\Dashboard\MealController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PackageController;
use App\Http\Controllers\Dashboard\SeoController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\WelcomeController;

Route::group(
    [
        'prefix' => 'dashboard',
        'as' => 'dashboard.',
    ],
    function () {
        ################# Auth ##############################
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        ################################# Reset Password #############################
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::controller(AuthController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('email');
                Route::post('email', 'sendOtp')->name('email.post');
                Route::get('verify', 'showOtpForm')->name('verify');
                Route::post('verify', 'verifyOtp')->name('verify.post');
                Route::get('reset', 'showResetForm')->name('reset');
                Route::post('reset', 'resetPassword')->name('reset.post');
            });
        });
        ################################## End Pssword #################################

        ################# Protected Routed  ##############################
        Route::group(['middleware' => 'auth'], function () {
            // ####################################### Welcome Routes #######################################
            Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');

            ####################################### Welcome Routes #######################################
            Route::resource('roles', RoleController::class)->middleware('permission:admins');
            Route::resource('managers', ManagerController::class)->middleware('permission:admins');

            Route::patch('/managers/{id}/role', [ManagerController::class, 'updateprofile'])->name('dashboard.managers.updateprofile');

            ####################################### Settings Routes #######################################
            Route::get('settings', [SettingController::class, 'index'])
                ->name('settings')
                ->middleware('permission:settings');

            Route::put('settings/{id}', [SettingController::class, 'update'])
                ->name('settings.update')
                ->middleware('permission:settings');

            ####################################### Book Routes #######################################
            Route::get('book', [BookController::class, 'index'])
                ->name('book.index')
                ->middleware('permission:book');

            Route::put('book/{id}', [BookController::class, 'update'])
                ->name('book.update')
                ->middleware('permission:book');

            ####################################### Blog Routes #######################################
            Route::resource('blog', BlogController::class)->middleware('permission:blog');

            ####################################### Courses Routes #######################################
            Route::resource('courses', CourseController::class)->middleware('permission:courses');

            ####################################### Customers Routes #######################################
            Route::get('customers', [CustomersController::class, 'index'])
                ->name('customers.index')
                ->middleware('permission:manage_customers');

            Route::patch('customers/{customer}/toggle', [CustomersController::class, 'toggleStatus'])
                ->name('customers.toggle')
                ->middleware('permission:manage_customers');

            ########################### Order Routes ###################
            Route::get('orders', [OrderController::class, 'index'])
                ->name('orders.index')
                ->middleware('permission:orders');

            Route::get('orders/{order}', [OrderController::class, 'show'])
                ->name('orders.show')
                ->middleware('permission:orders');

            Route::patch('orders/items/{item}/toggle', [OrderController::class, 'toggleItemStatus'])
                ->name('orders.items.toggle')
                ->middleware('permission:orders');

            ####################################### Category Routes #######################################
            Route::resource('category', CategoryController::class)->middleware('permission:blog');

            ####################################### Tag Routes #######################################
            Route::resource('tag', TagController::class)->middleware('permission:blog');
            Route::get('/tags/search', [TagController::class, 'search'])->name('tags.search');

            ####################################### Testmonials Routes #######################################
            Route::resource('faq', FaqController::class)->middleware('permission:faq');

            Route::get('/faqdetails', [FaqDetailController::class, 'index'])
                ->name('faqdetails.index')
                ->middleware('permission:faq');

            Route::put('/faqdetails/{id}', [FaqDetailController::class, 'update'])
                ->name('faqdetails.update')
                ->middleware('permission:faq');

            ####################################### Message Routes #######################################
            Route::get('messages', [MessagesController::class, 'index'])
                ->name('messages.index')
                ->middleware('permission:manage_customers');

            ####################################### Seo Routes #######################################
            Route::get('/seo', [SeoController::class, 'index'])
                ->name('seo.index')
                ->middleware('permission:seo');
            Route::get('/seo/{id}', [SeoController::class, 'edit'])
                ->name('seo.edit')
                ->middleware('permission:seo');
            Route::put('/seo/{id}', [SeoController::class, 'update'])
                ->name('seo.update')
                ->middleware('permission:seo');

            ####################################### CodeSnippet Routes #######################################
            Route::get('/code-snippet', [CodeSnippetController::class, 'index'])
                ->name('code-snippet')
                ->middleware('permission:seo');
            Route::put('/code-snippet', [CodeSnippetController::class, 'update'])
                ->name('code-snippet.update')
                ->middleware('permission:seo');
        });
    },
);
