<?php

namespace App\Application\DTOs\Recipe;

final class EditRecipeOutputDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly ?int $preparationTimeMinutes,
        public readonly ?int $servings,
        public readonly ?array $ingredients,
        public readonly array $steps,
        public readonly string $user_id,
        public readonly ?string $category_id,
    ) {}
}
