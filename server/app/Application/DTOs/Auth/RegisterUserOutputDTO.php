<?php

namespace App\Application\DTOs\Auth;

final class RegisterUserOutputDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $login,
    ) {}
}