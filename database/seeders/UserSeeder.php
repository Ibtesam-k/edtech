<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 
        // Create 10 teacher users
        User::factory()->count(10)->state([
            'role' => 'teacher',
        ])->create();

        // Create 50 student users
        User::factory()->count(50)->state([
            'role' => 'student',
        ])->create();

        // Create the default admin user
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), 
                'role' => 'teacher', 
            ]);
        }
    }
}
