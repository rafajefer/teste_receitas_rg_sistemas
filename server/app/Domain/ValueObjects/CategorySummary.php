<?php

namespace App\Domain\ValueObjects;

class CategorySummary
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $name
    ) {}
}
