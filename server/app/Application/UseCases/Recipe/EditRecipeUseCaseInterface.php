<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\EditRecipeInputDTO;
use App\Application\DTOs\Recipe\EditRecipeOutputDTO;

interface EditRecipeUseCaseInterface
{
    public function execute(EditRecipeInputDTO $dto): EditRecipeOutputDTO;
}
