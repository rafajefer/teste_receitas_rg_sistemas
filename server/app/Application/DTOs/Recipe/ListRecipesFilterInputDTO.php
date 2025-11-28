<?php

namespace App\Application\DTOs\Recipe;

final class ListRecipesFilterInputDTO
{
    public function __construct(
        public readonly ?string $title = null
    ) {}
}
