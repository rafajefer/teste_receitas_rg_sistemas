<?php

namespace App\Application\DTOs\Recipe;

final class CreateRecipeInputDTO
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?int $preparationTimeMinutes,
        public readonly ?int $servings,
        public readonly ?array $ingredients,
        public readonly array $steps,
        public readonly int $userId,
        public readonly ?int $categoryId,
    ) {}
}
