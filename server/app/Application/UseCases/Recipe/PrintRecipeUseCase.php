<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Recipe\PrintRecipeOutputDTO;
use App\Domain\Repositories\RecipeRepositoryInterface;

final class PrintRecipeUseCase implements PrintRecipeUseCaseInterface
{
    public function __construct(
        private RecipeRepositoryInterface $recipeRepository
    ) {}

    public function execute(string $id): PrintRecipeOutputDTO
    {
        $recipe = $this->recipeRepository->findById($id);
        return new PrintRecipeOutputDTO(
            id: $recipe->id,
            title: $recipe->title,
            preparationTimeMinutes: $recipe->preparationTimeMinutes,
            servings: $recipe->servings,
            ingredients: $recipe->ingredients,
            steps: $recipe->steps,
            userName: $recipe->user->name,
            categoryName: $recipe->category->name
        );
    }
}
