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
        // If the request expects JSON, return null
        if ($request->expectsJson()) {
            return null;
        }

        // Redirect driver requests
        if ($request->is('driver/*')) {
            return route('driver.login'); 
        }

        // Redirect passenger requests
        if ($request->is('passenger/*')) {
            return route('passenger.login'); 
        }

        // ✅ Fallback return value (ensure the 'welcome' route exists in web.php)
        return route('welcome');
}
}