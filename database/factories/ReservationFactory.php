<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\PaymentMethod;
use App\Models\Reservation;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'status' => Reservation::PENDING,
            'added_by' => User::inRandomOrder()->first()->id, // Assign a random user ID
            'resource_id' => Resource::inRandomOrder()->first()->id, // Assign a random resource ID
            'course_id' => Course::inRandomOrder()->first()->id,
            'user_id' => User::typeUser()->inRandomOrder()->first()->id,
            'is_verified_payment' => $this->faker->boolean,
            'payment_method_id' => PaymentMethod::inRandomOrder()->first()->id,
        ];
    }
}
