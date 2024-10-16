<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getting users by valid role (students).
     *
     * @return void
     */
    public function test_get_users_by_role_student()
    {
        // Create users with the role 'student'
        User::factory()->count(3)->create(['role' => 'student']);
        User::factory()->count(2)->create(['role' => 'teacher']);

       // Simulate user login to get a token
       $user = User::first(); // Create a user
       $token = JWTAuth::fromUser($user); // Generate JWT token

       $response = $this->withHeaders([
           'Authorization' => 'Bearer ' . $token,
       ])->getJson('/api/v1/users?role=student'); 

        // Assert the response is successful and the role is 'student'
        $response->assertStatus(200)
        // Check that the 'data' key contains exactly 3 items
        ->assertJsonCount(3, 'data') 
        ->assertJsonFragment(['role' => 'student']);
    }

    /**
     * Test getting users by valid role (teachers).
     *
     * @return void
     */
    public function test_get_users_by_role_teacher()
    {
        // Create users with the role 'teacher'
        User::factory()->count(5)->create(['role' => 'teacher']);
        User::factory()->count(1)->create(['role' => 'student']);

         // Simulate user login to get a token
         $user = User::first(); // Create a user
         $token = JWTAuth::fromUser($user); // Generate JWT token

         $response = $this->withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->getJson('/api/v1/users?role=teacher'); 
     
        // Assert the response is successful and the role is 'teacher'
        $response->assertStatus(200)
        // Check that the 'data' key contains exactly 5 items
        ->assertJsonCount(5, 'data') 
        ->assertJsonFragment(['role' => 'teacher']);
    }

    /**
     * Test getting users with an invalid role.
     *
     * @return void
     */
    public function test_get_users_by_invalid_role()
    {
             // Simulate user login to get a token
            $user = User::factory()->create(); // Create a user
            $token = JWTAuth::fromUser($user); // Generate JWT token

             // Call the endpoint with an invalid role
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->getJson('/api/v1/users?role=invalid'); 
     

        // Assert that the request fails with a 400 status
        $response->assertStatus(400)
            ->assertJsonFragment(['error' => 'Invalid role. Valid roles are: student, teacher']);
    }

    /**
     * Test getting all users without filtering by role.
     *
     * @return void
     */
    public function test_get_all_users_without_role_filter()
    {
     // Simulate user login to get a token
    $user = User::factory()->create(); // Create a user
    $token = JWTAuth::fromUser($user); // Generate JWT token

    // Make a request with the token
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->getJson('/api/v1/users'); 

    $response->assertStatus(200);
   $response->assertJsonStructure([
           'data' => [
            '*' => ['id', 'name', 'email'], 
                ]]); 
    }
}
