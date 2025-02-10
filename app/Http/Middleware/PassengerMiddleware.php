<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('passenger')->check()) {
            return redirect()->route('passenger.login')->with('error', 'You must log in as a passenger.');
        }
        return $next($request);
    }
}

