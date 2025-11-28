<?php

namespace App\Application\UseCases\Recipe;

use App\Domain\Repositories\RecipeRepositoryInterface;

final class DeleteRecipeUseCase implements DeleteRecipeUseCaseInterface
{
    public function __construct(
        private RecipeRepositoryInterface $recipeRepository
    ) {}

    public function execute(string $id): void
    {
        $this->recipeRepository->delete($id);
    }
}
