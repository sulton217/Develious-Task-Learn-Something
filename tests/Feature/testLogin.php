<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class testLogin extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testLogin() 
{
    $input = User::factory()->create([
        'email' => 'admin22@gmail.com',
        'password' => bcrypt('123456')
     ]);
    $baseUrl =  '/api/auth/login';
    $email = 'admin22@gmail.com';
    $password = '123456';

    $response = $this->json('POST', $baseUrl . '/', [
        'email' => $email,
        'password' => $password
    ]);

    $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'access_token', 'token_type', 'expires_in'
        ]);
}

public function testLogout()
{
    $email = 'admin22@gmail.com';
    // $baseUrl =  '/api/auth/logout';

    $user = User::where('email', $email)->first();
    $token = JWTAuth::fromUser($user);
    $baseUrl =  '/api/auth/logout?token=' . $token;

    $response = $this->json('POST', $baseUrl, []);

    $response
        ->assertStatus(200);

    User::where('email','admin22@gmail.com')->delete();
}



}
