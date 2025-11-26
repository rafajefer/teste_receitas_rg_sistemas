<?php

namespace App\Domain\Services\Token;

interface TokenServiceInterface
{
    public function generate(int $userId): string;
}