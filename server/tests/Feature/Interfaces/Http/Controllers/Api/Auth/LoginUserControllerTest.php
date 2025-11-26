<?php

namespace Tests\Feature\Interfaces\Http\Controllers\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;

class LoginUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_success_returns_token(): void
    {
        UserModel::create([
            'nome' => 'Rafael',
            'login' => 'rafael123',
            'senha' => 'senhaSegura',
        ]);

        $response = $this->postJson('/api/auth/login', [
            'login' => 'rafael123',
            'password' => 'senhaSegura',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['accessToken']);
    }

    public function test_login_invalid_credentials_returns_unauthorized(): void
    {
        UserModel::create([
            'nome' => 'Rafael',
            'login' => 'rafael123',
            'senha' => 'senhaSegura',
        ]);

        $response = $this->postJson('/api/auth/login', [
            'login' => 'rafael123',
            'password' => 'senhaErrada',
        ]);

        $response->assertStatus(401);
        $response->assertJsonFragment(['error' => 'Credenciais inválidas.']);
    }
}
