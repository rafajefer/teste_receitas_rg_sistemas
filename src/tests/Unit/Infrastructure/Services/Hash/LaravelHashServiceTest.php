<?php

namespace Tests\Unit\Infrastructure\Services\Hash;

use App\Infrastructure\Services\Hash\LaravelHashService;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

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
}
