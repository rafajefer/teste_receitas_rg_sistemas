<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\CategorySummary;
use App\Domain\ValueObjects\UserSummary;

class RecipeEntity
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly ?int $preparationTimeMinutes,
        public readonly ?int $servings,
        public readonly ?array $ingredients,
        public readonly array $steps,
        public readonly UserSummary $user,
        public readonly CategorySummary $category,
    ) {}
}
