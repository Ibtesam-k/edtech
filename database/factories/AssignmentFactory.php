<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(),
            'course_id' => \App\Models\Course::inRandomOrder()->first()->id, 
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'), 
        ];
    }
}
