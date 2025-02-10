<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('driver')->check()) {
            return redirect()->route('driver.login')->with('error', 'You must log in as a driver.');
        }
        return $next($request);
    }
}
