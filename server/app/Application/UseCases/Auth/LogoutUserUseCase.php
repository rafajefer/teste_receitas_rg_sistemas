<?php

namespace App\Application\UseCases\Auth;

use App\Domain\Services\Token\TokenServiceInterface;

final class LogoutUserUseCase
{
    public function __construct(
        private TokenServiceInterface $tokenService
    ) {}

    public function execute(string $tokenId)
    {
        $this->tokenService->revokeCurrentToken($tokenId);
    }
}
