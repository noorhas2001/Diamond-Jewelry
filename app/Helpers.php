<?php

use App\Models\Setting;
use Carbon\Translator;
use Illuminate\Console\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

if (!function_exists('hereShowRoutes')) {
    function hereShowRoutes(array $routes, $output = 'here show')
    {
        if (in_array(Route::currentRouteName(), $routes, true)) {
            return $output;
        }
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null, $lang = false)
    {
        if (env('APP_ENV') == 'production') {
            $settings = Cache::remember('settings', 86400, function () {
                return Setting::all();
            });

            $setting = $settings->where('name', $key)->first();
        } else {
            $setting = Setting::query()->where('name', $key)->first();
        }

        return $setting == null ? $default : $setting->value;
    }
}

if (!function_exists('translate')) {
    function translate($key): array|string|Translator|Application|null
    {
        return __($key);
    }
}


if (!function_exists('handleErrors')) {
    function handleErrors($validator): JsonResponse
    {
        return response()->json([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()
        ], 422);
    }
}




