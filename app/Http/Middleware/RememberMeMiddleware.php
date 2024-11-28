<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RememberMeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('remember') && $request->input('remember') == 'true') {
            // Setting a cookie manually to track "Remember Me" for 30 days
            Cookie::queue('remember_me', 'true', 60 * 24 * 30); // 30 days
        } else {
            // Forget the cookie if "Remember Me" is not selected
            Cookie::queue(Cookie::forget('remember_me'));
        }

        return $next($request);
    }
}
