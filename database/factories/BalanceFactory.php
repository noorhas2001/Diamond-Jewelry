<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Reservation;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => fake()->randomFloat(2, 1, 50),
            'sender_id' => User::all()->skip(1)->first()->id,
            'receiver_id' => User::all()->first()->id,
            'currency_id' => Currency::all()->random()->id,
            'description' => fake()->text,
            'payment_type' => fake()->randomElement(['resource', 'course']),
            'payment_id' => Resource::all()->random()->id,
        ];
    }
}
