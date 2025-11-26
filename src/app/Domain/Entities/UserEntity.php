<?php

namespace App\Domain\Entities;

final class UserEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $login,
        public readonly string $password
    ) {}
}