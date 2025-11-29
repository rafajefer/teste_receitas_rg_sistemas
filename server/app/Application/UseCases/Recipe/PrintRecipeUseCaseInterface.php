<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\PrintRecipeOutputDTO;

interface PrintRecipeUseCaseInterface
{
    public function execute(string $id): PrintRecipeOutputDTO;
}
