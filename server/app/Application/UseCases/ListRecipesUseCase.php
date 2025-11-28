<?php

namespace App\Application\UseCases;

use App\Application\DTOs\Recipe\RecipeListItemOutputDTO;
use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;
use App\Domain\Repositories\RecipeRepositoryInterface;

final class ListRecipesUseCase implements ListRecipesUseCaseInterface
{
    public function __construct(
        private RecipeRepositoryInterface $recipeRepository
    ) {}

    /**
     * @param ListRecipesFilterInputDTO $filter
     * @return RecipeListItemOutputDTO[]
     */
    public function execute(ListRecipesFilterInputDTO $filter): array
    {
        $recipes = $this->recipeRepository->all($filter);
        return array_map(
            fn($recipe) => new RecipeListItemOutputDTO(
                id: $recipe->id,
                title: $recipe->title,
                preparationTimeMinutes: $recipe->preparationTimeMinutes,
                servings: $recipe->servings,
                ingredients: $recipe->ingredients,
                steps: $recipe->steps,
                userId: $recipe->user->id,
                userName: $recipe->user->name,
                categoryId: $recipe->category->id,
                categoryName: $recipe->category->name
            ),
            $recipes
        );
    }
}
