<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function findByLogin(string $login): ?UserEntity;
}