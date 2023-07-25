<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        if (Session::has(APP_LOCALE) && array_key_exists(Session::get(APP_LOCALE), Config::get(LANGUAGE))) {
            app()->setLocale(Session::get(APP_LOCALE));
        } else {
            app()->setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
}
