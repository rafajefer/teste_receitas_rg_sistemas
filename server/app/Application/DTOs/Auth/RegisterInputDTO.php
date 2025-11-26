<?php

namespace App\DTOs\Auth;

final class RegisterInputDTO
{
    public function __construct(
        public string $name,
        public string $login,
        public string $password,
    ) {}
}