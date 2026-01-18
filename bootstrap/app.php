<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web'])
                ->group(base_path('routes/dashboard.php'));
            Route::middleware(['web'])
                ->group(base_path('routes/sitemap.php'));
        },
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(function(){
            if(request()->is('*/dashboard/*')){
                return route('dashboard.login');
            }
            else{
                return route('customer.login.show');
            }
        });

        $middleware->redirectUsersTo(function(){
            if(Auth::guard('web')->check()){
               return route('dashboard.welcome');
            }
            else {
               return route('/');
            }
           });

        $middleware->alias([
            /**** OTHER MIDDLEWARE ALIASES ****/
            'permission' => \App\Http\Middleware\CheckPermission::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
