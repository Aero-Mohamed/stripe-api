<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful login.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'status_code',
                'data' => [
                    'token',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'registered_at',
                    ],
                ],
                'message',
                'errors',
            ]);
    }

    /**
     * Test login with invalid credentials.
     *
     * @return void
     */
    public function testLoginWithInvalidCredentials()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email'    => 'invalid@example.com',
            'password' => 'wrongPassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Invalid credentials',
            ]);
    }
}
