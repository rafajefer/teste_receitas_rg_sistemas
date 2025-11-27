<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\RecipeEntity;

interface RecipeRepositoryInterface
{
    public function create(RecipeEntity $recipe): RecipeEntity;
}
