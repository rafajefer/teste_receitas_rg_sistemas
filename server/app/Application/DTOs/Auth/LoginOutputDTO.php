<?php

namespace App\Application\DTOs\Auth;

final class LoginOutputDTO
{
    public function __construct(
        public string $accessToken
    ) {}
}