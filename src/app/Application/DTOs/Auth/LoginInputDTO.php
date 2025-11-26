<?php

namespace App\Application\DTOs\Auth;

final class LoginInputDTO
{
    public function __construct(
        public string $login,
        public string $password,
    ) {}
}