<?php

namespace App\Infrastructure\Services\Hash;

use App\Domain\Services\Hash\HashServiceInterface;
use Illuminate\Support\Facades\Hash;

final class LaravelHashService implements HashServiceInterface
{
    public function check(string $plain, string $hashed): bool
    {
        return Hash::check($plain, $hashed);
    }

    public function make(string $value): string
    {
        return Hash::make($value);
    }
}