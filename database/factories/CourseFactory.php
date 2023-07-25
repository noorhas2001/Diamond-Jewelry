<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'added_by' => 1,
            'resource_id' => Resource::all()->random()->id,
            'price' => 5,
            'hours' => 2,
            'description' => fake()->text,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
        ];
    }
}
