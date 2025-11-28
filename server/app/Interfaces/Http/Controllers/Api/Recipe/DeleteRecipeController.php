<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\UseCases\Recipe\DeleteRecipeUseCaseInterface;
use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteRecipeController extends Controller
{
    public function __construct(
        private DeleteRecipeUseCaseInterface $deleteRecipeUseCase
    ) {}

    public function __invoke(string $id): JsonResponse
    {
        $this->deleteRecipeUseCase->execute($id);
        return response()->json(['message' => 'Recipe deleted successfully.']);
    }
}
