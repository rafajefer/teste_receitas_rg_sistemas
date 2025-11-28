<?php

namespace App\Domain\Services\Token;

interface TokenServiceInterface
{
    public function generate(int $userId): string;
    public function revokeCurrentToken(int $tokenId): void;
    public function revokeAllTokens(int $userId): void;
}