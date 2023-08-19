<?php

namespace App\Http\Middleware;

use Closure;

class PasswordConfirmationMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('password_confirmed')) {
            return back();
        }

        return $next($request);
    }
}
