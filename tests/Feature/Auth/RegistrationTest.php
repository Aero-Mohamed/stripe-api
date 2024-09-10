<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful registration.
     *
     * @return void
     */
    public function testSuccessfulRegistration(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name'                  => 'John Doe',
            'email'                 => 'john@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'status_code',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'registered_at',
                ],
                'message',
                'errors',
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    /**
     * Test registration with validation errors.
     *
     * @return void
     */
    public function testRegistrationWithValidationErrors(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name'                  => '',
            'email'                 => 'invalid-email',
            'password'              => 'short',
            'password_confirmation' => 'differentPassword',
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'status_code',
                'data',
                'message',
                'errors' => [
                    'name',
                    'email',
                    'password',
                ],
            ]);
    }
}
