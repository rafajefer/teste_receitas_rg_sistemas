<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\CreateRecipeInputDTO;
use App\Application\DTOs\Recipe\CreateRecipeOutputDTO;
use App\Domain\Factories\RecipeFactory;
use App\Domain\Repositories\RecipeRepositoryInterface;

class CreateRecipeUseCase
{
    public function __construct(
        private RecipeRepositoryInterface $recipeRepository
    ) {}

    public function execute(CreateRecipeInputDTO $dto): CreateRecipeOutputDTO
    {
        $recipeEntity = RecipeFactory::createForWrite(
            id: 0,
            title: $dto->title,
            preparationTimeMinutes: $dto->preparationTimeMinutes,
            servings: $dto->servings,
            ingredients: $dto->ingredients,
            steps: $dto->steps,
            userId: $dto->userId,
            categoryId: $dto->categoryId
        );

        $recipe = $this->recipeRepository->create($recipeEntity);

        return new CreateRecipeOutputDTO(
            id: $recipe->id,
            title: $recipe->title,
            preparationTimeMinutes: $recipe->preparationTimeMinutes,
            servings: $recipe->servings,
            ingredients: $recipe->ingredients,
            steps: $recipe->steps,
            userId: $recipe->user->id,
            categoryId: $recipe->category->id
        );
    }
}
