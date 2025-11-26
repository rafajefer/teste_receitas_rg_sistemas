<?php

namespace Tests\Unit\Domain\Entities;

use App\Domain\Entities\UserEntity;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function test_user_entity_properties_are_set_correctly(): void
    {
        $user = new UserEntity(
            id: 1,
            name: 'Rafael',
            login: 'rafael123',
            password: 'senhaSegura'
        );

        $this->assertEquals(1, $user->id);
        $this->assertEquals('Rafael', $user->name);
        $this->assertEquals('rafael123', $user->login);
        $this->assertEquals('senhaSegura', $user->password);
    }

    public function test_user_entity_accepts_null_id(): void
    {
        $user = new UserEntity(
            id: null,
            name: 'Rafael',
            login: 'rafael123',
            password: 'senhaSegura'
        );

        $this->assertNull($user->id);
        $this->assertEquals('Rafael', $user->name);
        $this->assertEquals('rafael123', $user->login);
        $this->assertEquals('senhaSegura', $user->password);
    }
}
