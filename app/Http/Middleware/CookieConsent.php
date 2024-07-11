<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CookieConsent
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->cookie('cookie_consent')) {
            view()->share('showCookieConsent', true);
        }

        return $next($request);
    }
}
