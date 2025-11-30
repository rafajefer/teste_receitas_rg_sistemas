<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Report\PdfFileOutputDTO;
use App\Domain\Repositories\RecipeRepositoryInterface;
use App\Domain\Services\PdfGenerator\PdfGenerationServiceInterface;

final class PrintRecipeUseCase implements PrintRecipeUseCaseInterface
{
    public function __construct(
        private RecipeRepositoryInterface $recipeRepository,
        private PdfGenerationServiceInterface $pdfGenerationService
    ) {}

    public function execute(string $id): PdfFileOutputDTO
    {
        $recipe = $this->recipeRepository->findById($id);
        return $this->pdfGenerationService->generate(
            data: ['recipe' => $recipe],
            view: 'recipes.print',
            filename: 'recipe_' . $recipe->id . '.pdf'
        );
    }
}
