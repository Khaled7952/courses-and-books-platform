<?php

namespace App\Providers;

use App\Models\Seo;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
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
        $seo = cache()->rememberForever('global_seo', function () {
            return Seo::all()->keyBy(function ($item) {
                return strtolower($item->page_name);
            });
        });

        view()->share([
            'global_seo' => $seo,
        ]);
    }
}
