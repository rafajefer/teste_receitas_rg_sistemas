<?php

namespace App\Domain\Repositories;

use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;
use App\Domain\Entities\RecipeEntity;

interface RecipeRepositoryInterface
{
    public function create(RecipeEntity $recipe): RecipeEntity;

    /**
     * @param ListRecipesFilterInputDTO $filter
     * @return RecipeEntity[]
     */
    public function all(ListRecipesFilterInputDTO $filter): array;

    public function update(RecipeEntity $recipe): RecipeEntity;

    public function delete(string $id): void;
}