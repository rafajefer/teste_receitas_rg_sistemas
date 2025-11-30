<?php

namespace Tests\Unit\Infrastructure\Services\Hash;

use App\Infrastructure\Services\Hash\LaravelHashService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

final class LaravelHashServiceTest extends TestCase
{
    private LaravelHashService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new LaravelHashService();
        Hash::shouldReceive('check')->andReturnUsing(function ($plain, $hashed) {
            return $plain === 'senha_correta' && $hashed === 'hash_correto';
        });
        Hash::shouldReceive('make')->andReturnUsing(function ($plain) {
            return password_hash($plain, PASSWORD_BCRYPT);
        });
    }

    public function test_check_returns_true_for_valid_hash(): void
    {
        $result = $this->service->check('senha_correta', 'hash_correto');
        $this->assertTrue($result);
    }

    public function test_check_returns_false_for_invalid_hash(): void
    {
        $result = $this->service->check('senha_errada', 'hash_correto');
        $this->assertFalse($result);

        $result = $this->service->check('senha_correta', 'hash_errado');
        $this->assertFalse($result);
    }

    public function test_make_returns_bcrypt_hash(): void
    {
        $plain = 'senha_teste';
        $hash = $this->service->make($plain);

        $this->assertIsString($hash);
        $this->assertTrue(password_verify($plain, $hash));
        $this->assertStringStartsWith('$2y$', $hash);
    }

    public function test_make_hash_is_unique_for_same_input(): void
    {
        $plain = 'senha_teste';
        $hash1 = $this->service->make($plain);
        $hash2 = $this->service->make($plain);

        $this->assertNotEquals($hash1, $hash2);
    }
}
