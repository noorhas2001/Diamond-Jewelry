<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function getUserNotifications(): JsonResponse
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        $formattedNotifications = $notifications->map(function ($notification) {
            return [
                'id' => $notification->id,
                'title' => $notification->data['title'],
                'body' => $notification->data['body'],
                'date' => $notification->data['start_date'],
            ];
        });

        return response()->json([
            'data' => $formattedNotifications
        ], OK);
    }
}
