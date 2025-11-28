<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\DTOs\Recipe\CreateRecipeInputDTO;
use App\Application\UseCases\Recipe\CreateRecipeUseCase;
use App\Domain\Exceptions\InvalidCredentialsException;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Recipe\CreateRecipeRequest;
use Illuminate\Http\JsonResponse;

class CreateRecipeController extends Controller
{
    public function __invoke(CreateRecipeRequest $request, CreateRecipeUseCase $useCase): JsonResponse
    {
        try {
            $inputDTO = new CreateRecipeInputDTO(
                title: $request->title,
                preparationTimeMinutes: $request->preparation_time_minutes,
                servings: $request->servings,
                ingredients: $request->ingredients,
                steps: $request->steps,
                userId: $request->user()->id,
                categoryId: $request->category_id,
            );
            $outputDTO = $useCase->execute($inputDTO);
            return response()->json($outputDTO, 200);
        } catch (InvalidCredentialsException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 401);
        } catch (\DomainException $e) {
            return response()->json([
                'error' => 'Erro de domínio: ' . $e->getMessage(),
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Erro interno do servidor.'
            ], 500);
        }
    }
}
