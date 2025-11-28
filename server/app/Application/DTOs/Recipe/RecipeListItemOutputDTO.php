<?php

namespace App\Application\DTOs\Recipe;

final class RecipeListItemOutputDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly ?int $preparationTimeMinutes,
        public readonly ?int $servings,
        public readonly ?array $ingredients,
        public readonly array $steps,
        public readonly string $userId,
        public readonly string $userName,
        public readonly ?string $categoryId,
        public readonly ?string $categoryName,
    ) {}
}
