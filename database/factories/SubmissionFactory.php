<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assignment_id' => \App\Models\Assignment::inRandomOrder()->first()->id, 
            'student_id'=> \App\Models\User::where('role', 'student')->inRandomOrder()->first()->id, 
            'submitted_at' => $this->faker->dateTimeThisDecade(),
            'file_path' => 'files/submission_' . $this->faker->unique()->numberBetween(1, 100) . '.txt',
        ];
    }
}
