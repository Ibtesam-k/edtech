<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create 10 teachers
        User::factory()->count(10)->state([
            'role' => 'teacher'
        ])->create();

        // Create 50 students
        User::factory()->count(50)->state([
            'role' => 'student'
        ])->create();

        $this->call([
            CourseSeeder::class,
            // other seeders...
        ]);
        }

      
}
