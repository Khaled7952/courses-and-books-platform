<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Header;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settings = cache()->rememberForever('settings', function () {
            return Setting::first() ?? null;
        });

        $book = cache()->rememberForever('book', function () {
            return Book::first();
        });

        view()->share('settings', $settings);
        view()->share('book', $book);
    }
}
