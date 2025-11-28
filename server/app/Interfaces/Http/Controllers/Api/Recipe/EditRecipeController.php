<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\DTOs\Recipe\EditRecipeInputDTO;
use App\Application\UseCases\Recipe\EditRecipeUseCaseInterface;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Recipe\EditRecipeRequest;
use Illuminate\Http\JsonResponse;

class EditRecipeController extends Controller
{
    public function __construct(
        private EditRecipeUseCaseInterface $useCase
    ) {}

    public function __invoke(string $id, EditRecipeRequest $request): JsonResponse
    {
        $dto = new EditRecipeInputDTO(
            id: $id,
            title: $request->validated('title'),
            preparationTimeMinutes: $request->validated('preparation_time_minutes'),
            servings: $request->validated('servings'),
            ingredients: $request->validated('ingredients'),
            steps: $request->validated('steps'),
            categoryId: $request->validated('category_id')
        );
        $recipe = $this->useCase->execute($dto);
        return response()->json($recipe);
    }
}
