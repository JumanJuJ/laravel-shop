<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_receive_api_token(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'device_name' => 'postman',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('token_type', 'Bearer')
            ->assertJsonPath('user.email', 'mario@example.com')
            ->assertJsonPath('abilities', ['products:read', 'orders:create'])
            ->assertJsonStructure([
                'token',
                'abilities',
                'user' => ['id', 'name', 'email'],
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'mario@example.com',
        ]);

        $this->assertDatabaseCount('personal_access_tokens', 1);
    }

    public function test_user_can_login_and_receive_api_token(): void
    {
        $user = User::factory()->create([
            'email' => 'mario@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'mobile',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('token_type', 'Bearer')
            ->assertJsonPath('user.email', $user->email)
            ->assertJsonPath('abilities', ['products:read', 'orders:create'])
            ->assertJsonStructure(['token']);

        $this->assertDatabaseCount('personal_access_tokens', 1);
    }

    public function test_user_can_not_login_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('email');

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_user_can_use_and_revoke_api_token(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $this->getJson('/api/user', [
            'Authorization' => "Bearer {$token}",
        ])
            ->assertOk()
            ->assertJsonPath('user.email', $user->email);

        $this->postJson('/api/logout', [], [
            'Authorization' => "Bearer {$token}",
        ])
            ->assertOk()
            ->assertJsonPath('message', 'Token revocato correttamente.');

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }
}
