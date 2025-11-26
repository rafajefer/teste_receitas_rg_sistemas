<?php 

namespace App\Domain\Factories;

use App\Domain\Entities\UserEntity;

final class UserFactory
{
    public static function createFromArray(array $data): UserEntity
    {
        return new UserEntity(
            id: $data['id'] ?? null,
            name: $data['name'],
            login: $data['login'],
            password: $data['password']
        );
    }

    public static function createFromDb(object $dto): UserEntity
    {
        return new UserEntity(
            id: $dto->id,
            name: $dto->nome,
            login: $dto->login,
            password: $dto->senha
        );
    }
}