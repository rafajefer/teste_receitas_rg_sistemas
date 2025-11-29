<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Factories\UserFactory;
use App\Domain\Entities\UserEntity;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    public function test_create_from_db_returns_user_entity(): void
    {
        $dto = (object) [
            'id' => 2,
            'nome' => 'Maria',
            'login' => 'maria456',
            'senha' => 'senhaSuperSegura'
        ];

        $user = UserFactory::createFromDb($dto);

        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('2', $user->id);
        $this->assertEquals('Maria', $user->name);
        $this->assertEquals('maria456', $user->login);
        $this->assertEquals('senhaSuperSegura', $user->password);
    }

    public function test_create_from_db_accepts_null_id(): void
    {
        $dto = (object) [
            'id' => '',
            'nome' => 'João',
            'login' => 'joao789',
            'senha' => 'senhaJoao'
        ];

        $user = UserFactory::createFromDb($dto);

        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('', $user->id);
        $this->assertEquals('João', $user->name);
        $this->assertEquals('joao789', $user->login);
        $this->assertEquals('senhaJoao', $user->password);
    }

    public function test_create_from_array_returns_user_entity(): void
    {
        $data = [
            'id' => 1,
            'name' => 'Rafael',
            'login' => 'rafael123',
            'password' => 'senhaSegura'
        ];

        $user = UserFactory::createFromArray($data);

        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('1', $user->id);
        $this->assertEquals('Rafael', $user->name);
        $this->assertEquals('rafael123', $user->login);
        $this->assertEquals('senhaSegura', $user->password);
    }

    public function test_create_from_array_accepts_null_id(): void
    {
        $data = [
            'id' => '',
            'name' => 'Rafael',
            'login' => 'rafael123',
            'password' => 'senhaSegura'
        ];

        $user = UserFactory::createFromArray($data);

        $this->assertInstanceOf(UserEntity::class, $user);
        $this->assertEquals('', $user->id);
        $this->assertEquals('Rafael', $user->name);
        $this->assertEquals('rafael123', $user->login);
        $this->assertEquals('senhaSegura', $user->password);
    }
}
