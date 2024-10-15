<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
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
            'title' => $this->faker->sentence(3), // e.g., "Introduction to Programming"
            'description' => $this->faker->paragraph(), // e.g., "This course covers the basics of programming."
            'teacher_id' => \App\Models\User::where('role', 'teacher')->inRandomOrder()->first()->id, // Randomly assigns a teacher
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
