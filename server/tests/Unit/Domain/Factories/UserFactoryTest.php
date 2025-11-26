<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Factories\UserFactory;
use App\Domain\Entities\UserEntity;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    public function test_create_from_array_returns_user_entity(): void
    {
        $data = [
            'id' => 1,
            'nome' => 'Rafael',
            'login' => 'rafael123',
            'senha' => 'senhaSegura'
        ];

        $user = UserFactory::createFromArray($data);

        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals(1, $user->id);
        $this->assertEquals('Rafael', $user->name);
        $this->assertEquals('rafael123', $user->login);
        $this->assertEquals('senhaSegura', $user->password);
    }

    public function test_create_from_array_accepts_null_id(): void
    {
        $data = [
            'nome' => 'Rafael',
            'login' => 'rafael123',
            'senha' => 'senhaSegura'
        ];

        $user = UserFactory::createFromArray($data);

        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertNull($user->id);
        $this->assertEquals('Rafael', $user->name);
        $this->assertEquals('rafael123', $user->login);
        $this->assertEquals('senhaSegura', $user->password);
    }
}
