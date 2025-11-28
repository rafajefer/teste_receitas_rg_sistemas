<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function findById(string $id): UserEntity;
    public function findByLogin(string $login): UserEntity;
    public function create(UserEntity $user): UserEntity;
}