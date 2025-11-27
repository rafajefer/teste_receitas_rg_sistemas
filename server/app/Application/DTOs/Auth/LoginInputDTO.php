<?php

namespace App\Application\DTOs\Auth;

final class LoginInputDTO
{
    public function __construct(
        public readonly string $login,
        public readonly string $password,
    ) {}
}