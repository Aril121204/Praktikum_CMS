<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bagikan data ke semua view admin
        View::composer('admin.*', function ($view) {
            // Data ini akan tersedia di semua view admin
        });
    }
}
 