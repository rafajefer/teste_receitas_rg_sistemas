<?php

namespace App\Application\DTOs\Auth;

final class RegisterUserInputDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $login,
        public readonly string $password,
    ) {}
}