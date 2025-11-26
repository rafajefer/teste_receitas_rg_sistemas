<?php

namespace App\Domain\Services\Hash;

interface HashServiceInterface
{
    public function check(string $plain, string $hashed): bool;
    public function make(string $value): string;
}