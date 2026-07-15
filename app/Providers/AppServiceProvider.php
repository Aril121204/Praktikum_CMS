<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $setting = SiteSetting::first();

            $categories = Category::active()
                ->orderBy('sort_order')
                ->get();

            $view->with([
                'setting' => $setting,
                'categories' => $categories,
            ]);
        });
    }
}
