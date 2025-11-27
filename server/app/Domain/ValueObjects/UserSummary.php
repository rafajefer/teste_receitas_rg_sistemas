<?php

namespace App\Domain\ValueObjects;

class UserSummary
{
    public function __construct(
        public readonly string $id,
        public readonly string $name
    ) {}
}
