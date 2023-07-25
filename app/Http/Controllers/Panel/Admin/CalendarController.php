<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\Reservation;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\Factory;

class CalendarController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:' . CALENDAR_PERMISSION)->only('index');
        $this->middleware('permission:' . CREATE_CALENDAR_PERMISSION)->only('create', 'store');
        $this->middleware('permission:' . READ_CALENDAR_PERMISSION)->only('show');
        $this->middleware('permission:' . UPDATE_CALENDAR_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:' . DELETE_CALENDAR_PERMISSION)->only('destroy');
    }

    public function index(): Factory|View|Application
    {
        $events = array();
        $reservations = Reservation::all();

        foreach ($reservations as $reservation) {
            $reservationTimes = $reservation->reservationTimes; // Collection of ReservationTime models

            $resourceName = Resource::where('id' , $reservation->resource_id)->pluck('name');

            foreach ($reservationTimes as $reservationTime) {

                if($reservationTime->isPending()){
                    $color = '#00FF13';
                } else {
                    $color = '#FF3333';
                }

                $events[] = [
                    'id' => $reservationTime->id,
                    'name' => $resourceName,
                    'resource_id' => $reservation->resource_id,
                    'user_id' => $reservation->user_id,
                    'start_date' => $reservationTime->start_time,
                    'end_date' => $reservationTime->end_time,
                    'color' => $color,
                ];
            }
        }

        $users = User::typeUser()->get();
        $resources = Resource::all();
        $payment_methods = PaymentMethod::pluck('id', 'name');
        return view('admin.dashboard.calendar.index', [
            'events' => $events,
            'users' => $users,
            'resources' => $resources,
            'payment_methods' => $payment_methods,
        ]);
    }
}
