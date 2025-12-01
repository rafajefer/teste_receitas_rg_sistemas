<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\UseCases\Recipe\DeleteRecipeUseCaseInterface;
use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

   /**
    * @OA\Delete(
    *     path="/api/recipes/{id}",
    *     summary="Remove uma receita",
    *     tags={"Receitas"},
    *     security={{"sanctum":{}}},
    *      @OA\Parameter(
    *          name="id",
    *          in="path",
    *          required=true,
    *          @OA\Schema(type="string")
    *      ),
    *     @OA\Response(
    *         response=200,
    *         description="Receita removida",
    *         @OA\JsonContent(
    *             @OA\Property(property="message", type="string", example="Receita removida com sucesso.")
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Não autenticado",
    *         @OA\JsonContent(
    *             @OA\Property(property="error", type="string", example="Unauthenticated.")
    *         )
    *     )
    * )
    */
final class DeleteRecipeController extends Controller
{
    public function __construct(
        private DeleteRecipeUseCaseInterface $deleteRecipeUseCase
    ) {}

    public function __invoke(string $id): JsonResponse
    {
        try {
            $this->deleteRecipeUseCase->execute($id);
            return response()->json(['message' => 'Receita removida com sucesso.']);
        } catch (\DomainException $e) {
            return response()->json([
                'error' => 'Erro de domínio: ' . $e->getMessage(),
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Erro interno do servidor.',
            ], 500);
        }
    }
}
