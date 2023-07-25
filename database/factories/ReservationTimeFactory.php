<?php

namespace Database\Factories;

use App\Models\ReservationTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReservationTime>
 */
class ReservationTimeFactory extends Factory
{
    protected $model = ReservationTime::class;

    public function definition(): array
    {
        return [
            'start_time' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'cost' => $this->faker->randomFloat(2, 10, 100),
            'status' => 1,
        ];
    }
}
