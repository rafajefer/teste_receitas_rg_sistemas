<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\UseCases\Recipe\PrintRecipeUseCaseInterface;
use App\Interfaces\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PrintRecipeController extends Controller
{
    public function __construct(
        private PrintRecipeUseCaseInterface $printRecipeUseCase
    ) {}

    public function __invoke(string $id): Response
    {
        $recipe = $this->printRecipeUseCase->execute($id);
        $pdf = Pdf::loadView('recipes.print', ['recipe' => $recipe]);
        return $pdf->download('recipe_' . $recipe->id . '.pdf');
    }
}
