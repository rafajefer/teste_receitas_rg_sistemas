<?php

namespace App\Application\DTOs\Recipe;

final class CreateRecipeOutputDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly ?int $preparationTimeMinutes,
        public readonly ?int $servings,
        public readonly ?array $ingredients,
        public readonly array $steps,
        public readonly int $userId,
        public readonly ?int $categoryId
    ) {}
}
