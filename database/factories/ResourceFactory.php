<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resource>
 */
class ResourceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'added_by' => 1,
            'category_id' => Category::all()->random()->id,
            'name' => fake()->name,
            'description' => fake()->text,
            'number_seats' => fake()->numberBetween(0, 40),
            'price_by_hour' => 5,
            'price_by_day' => 40,
            'price_by_weak' => 100,
            'price_by_month' => 300,
        ];
    }
}
