<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class SetAppLanguage
{
    public function handle(Request $request, Closure $next)
    {
        $language = $request->header('Accept-Language');

        if ($language && in_array($language, Config::get('app.supported_languages'))) {
            App::setLocale($language); // Set the application locale
        }

        return $next($request);
    }
}