<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika URL mengandung '/admin', redirect ke admin login
        if ($request->is('admin/*')) {
            return route('admin.login');
        }

        // Untuk user biasa, redirect ke login default
        return $request->expectsJson() ? null : route('login');
    }
}