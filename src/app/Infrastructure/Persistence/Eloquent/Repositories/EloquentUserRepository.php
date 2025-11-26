<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\UserEntity;
use App\Domain\Factories\UserFactory;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findByLogin(string $login): ?UserEntity
    {
        $userModel = UserModel::where('login', $login)->first();
        if (!$userModel) {
            return null;
        }
        $data = array_merge($userModel->toArray(), [
            'senha' => $userModel->getAuthPassword()
        ]);
        return UserFactory::createFromArray($data);
    }
}