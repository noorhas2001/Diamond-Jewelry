<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    public function readOneNotification()
    {
        $user = auth()->user();
        $notificationId = request()->input('notification_id');

        $notification = DB::table('notifications')
            ->where('notifiable_id', $user->id)
            ->where('id', $notificationId)
            ->first();

        if ($notification) {
            $readAt = Carbon::now();

            DB::table('notifications')
                ->where('id', $notificationId)
                ->update(['read_at' => $readAt]);
        }

        return redirect()->back();
    }



    public function markAsRead(){
        $user = User::find(auth()->user()->id);

        foreach($user->unreadNotifications as $notification){
            $notification->markAsRead();

            // Note: You can delete all notification insted of markAsRead()
            // $notification->delete();
        }

        return redirect()->back();
    }
}
