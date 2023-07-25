<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\ReservationTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Reservation::all()->each(function ($reservation) {
            ReservationTime::factory()
                ->count(3) // Change the count as needed
                ->create([
                    'reservation_id' => $reservation->id,
                ]);
        });
    }
}
