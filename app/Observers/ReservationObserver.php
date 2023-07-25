<?php

namespace App\Observers;

use App\Models\Reservation;

class ReservationObserver
{
    public function deleting(Reservation $reservation)
    {
        // When a reservation is deleted, also delete its reservationTimes
        $reservation->reservationTimes()->delete();
    }
}

