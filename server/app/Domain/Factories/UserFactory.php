<?php 

namespace App\Domain\Factories;

use App\Domain\Entities\UserEntity;

final class UserFactory
{
    public static function createFromArray(array $data): UserEntity
    {
        return new UserEntity(
            id: $data['id'] ?? null,
            name: $data['nome'],
            login: $data['login'],
            password: $data['senha']
        );
    }
}