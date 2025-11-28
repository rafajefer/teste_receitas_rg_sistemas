<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;
use App\Application\UseCases\Recipe\ListRecipesUseCaseInterface;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Recipe\ListRecipeRequest;
use Illuminate\Http\JsonResponse;

class ListRecipeController extends Controller
{
    public function __invoke(ListRecipeRequest $request, ListRecipesUseCaseInterface $useCase): JsonResponse
    {
        $filter = new ListRecipesFilterInputDTO(
            title: $request->query('title')
        );
        $outputDTO = $useCase->execute($filter);
        return response()->json($outputDTO, 200);
    }
}
