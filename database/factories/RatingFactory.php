<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courseIds = Course::pluck('id')->toArray();

        return [
            'user_id' => 1,
            'course_id' => $this->faker->randomElement($courseIds),
            'value' => $this->faker->numberBetween(1, 5)
        ];
    }
}
