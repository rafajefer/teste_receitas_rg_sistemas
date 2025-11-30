<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\EditRecipeInputDTO;
use App\Application\DTOs\Recipe\EditRecipeOutputDTO;
use App\Domain\Factories\RecipeFactory;
use App\Domain\Repositories\RecipeRepositoryInterface;

final class EditRecipeUseCase implements EditRecipeUseCaseInterface
{
    public function __construct(
        private RecipeRepositoryInterface $recipeRepository
    ) {}

    public function execute(EditRecipeInputDTO $dto): EditRecipeOutputDTO
    {
        $recipeEntity = RecipeFactory::createForPut(
            id: $dto->id,
            title: $dto->title,
            preparationTimeMinutes: $dto->preparationTimeMinutes,
            servings: $dto->servings,
            ingredients: $dto->ingredients,
            steps: $dto->steps,
            categoryId: $dto->categoryId
        );

        $recipe = $this->recipeRepository->update($recipeEntity);

        return new EditRecipeOutputDTO(
            id: $recipe->id,
            title: $recipe->title,
            preparationTimeMinutes: $recipe->preparationTimeMinutes,
            servings: $recipe->servings,
            ingredients: $recipe->ingredients,
            steps: $recipe->steps,
            user_id: $recipe->user->id,
            category_id: $recipe->category->id
        );
    }
}
