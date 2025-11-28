<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\RecipeListItemOutputDTO;
use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;

interface ListRecipesUseCaseInterface
{
    /**
     * @param ListRecipesFilterDTO $filter
     * @return RecipeListItemOutputDTO[]
     */
    public function execute(ListRecipesFilterInputDTO $filter): array;
}
