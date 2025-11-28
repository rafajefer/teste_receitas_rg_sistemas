<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\UserEntity;
use App\Domain\Exceptions\UserAlreadyExistsException;
use App\Domain\Exceptions\UserNotFoundException;
use App\Domain\Factories\UserFactory;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findById(string $id): UserEntity
    {
        $userModel = UserModel::find($id);
        if (!$userModel) {
            throw new UserNotFoundException();
        }

        return UserFactory::createFromDb($userModel);
    }

    public function findByLogin(string $login): UserEntity
    {
        $userModel = UserModel::where('login', $login)->first();
        if (!$userModel) {
            throw new UserNotFoundException();
        }
        
        return UserFactory::createFromDb($userModel);
    }

    public function create(UserEntity $user): UserEntity
    {
        $userModel = UserModel::where('login', $user->login)->first();
        if ($userModel) {
            throw new UserAlreadyExistsException();
        }

        $userModel = new UserModel();
        $userModel->nome = $user->name;
        $userModel->login = $user->login;
        $userModel->senha = $user->password;
        $userModel->save();

        return UserFactory::createFromDb($userModel);
    }
}