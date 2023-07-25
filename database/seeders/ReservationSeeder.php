<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        Reservation::factory()
            ->count(5) // Change the count as needed
            ->create(
                [
                    'user_id' => User::typeUser()->inRandomOrder()->first(),
                    'course_id' => null,
                ]
            );

        Reservation::factory()
            ->count(5) // Change the count as needed
            ->create(
                [
                    'user_id' => null,
                    'course_id' => Course::inRandomOrder()->first(),
                    'isHasUser' => false,
                ]
            );
    }
}
