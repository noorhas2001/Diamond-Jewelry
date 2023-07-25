<?php

use App\Models\Reservation;
use App\Models\ReservationTime;
use App\Models\Setting;
use App\Models\User;
use Carbon\Translator;
use Illuminate\Console\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use JetBrains\PhpStorm\NoReturn;
use Kutia\Larafirebase\Messages\FirebaseMessage;

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


if (!function_exists('percentPending')) {
    function percentPending($totalCount, $totalCountPending): float|int
    {
        return $totalCount > 0 ? round(($totalCountPending / $totalCount) * 100) : 0;
    }
}


if (!function_exists('sendNotification')) {
    #[NoReturn] function sendNotification(Request $request): void
    {
        $url = config('notification.google_fcm_url');

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = config('larafirebase.authentication_key');

        $encodedData = json_encode([
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ],
            "data" => ["newData" => 'mohammed Data'],
        ]);

        $headers = [
            'Authorization:key='.$serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: '.curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
    }
}

if (!function_exists('toFirebase')) {
    function toFirebase($data): void
    {
        (new FirebaseMessage)
            ->withTitle($data['title'])
            ->withBody($data['body'])
            ->withAdditionalData($data['additional'])
            ->withPriority('high')->asMessage($data['tokens']);
    }
}

if (!function_exists('isArabicLang')) {
    function isArabicLang($request): bool
    {
        return $request->header(AcceptLanguage) == 'ar';
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

if (!function_exists('dayId')) {
    function dayId($day): int
    {
        return match (strtolower($day)) {
            'saturday' => 0,
            'sunday' => 1,
            'monday' => 2,
            'tuesday' => 3,
            'wednesday' => 4,
            'thursday' => 5,
            'friday' => 6,
            default => throw new InvalidArgumentException("Invalid day: $day"),
        };
    }
}


if (!function_exists('checkConflict')) {
    /**
     * @param  Reservation  $reservation
     * @param $reservationTime
     * @return mixed
     */
    function checkConflict(Reservation $reservation, $reservationTime): mixed
    {
        return Reservation::where('resource_id', $reservation->resource_id)
            ->where('status', '<>', Reservation::CANCELED)
            ->whereHas('reservationTimes', function ($query) use ($reservationTime) {
                $query->where(function ($subquery) use ($reservationTime) {
                    $subquery->where('start_time', '>=', $reservationTime->start_time)
                        ->where('end_time', '<=', $reservationTime->end_time);
                })->orWhere(function ($subquery) use ($reservationTime) {
                    $subquery->where('start_time', '<=', $reservationTime->start_time)
                        ->where('end_time', '>=', $reservationTime->start_time);
                })->orWhere(function ($subquery) use ($reservationTime) {
                    $subquery->where('start_time', '<=', $reservationTime->end_time)
                        ->where('end_time', '>=', $reservationTime->end_time);
                })->orWhere(function ($subquery) use ($reservationTime) {
                    $subquery->where('start_time', '<=', $reservationTime->start_time)
                        ->where('end_time', '>=', $reservationTime->end_time);
                });
            })
            ->get();
    }
}


