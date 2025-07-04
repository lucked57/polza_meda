<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LockedMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_locked) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['locked' => 'Your account has been locked. Please contact support.']);
        }

        return $next($request);
    }
}
