<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\UseCases\Recipe\PrintRecipeUseCaseInterface;
use App\Domain\Exceptions\RecipeNotFoundException;
use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @OA\Get(
 *     path="/api/recipes/{id}/print",
 *     summary="Imprime uma receita em PDF",
 *     tags={"Receitas"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="PDF gerado com sucesso",
 *         @OA\MediaType(
 *             mediaType="application/pdf",
 *             @OA\Schema(
 *                 type="string",
 *                 format="binary"
 *             )
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
final class PrintRecipeController extends Controller
{
    public function __construct(
        private PrintRecipeUseCaseInterface $printRecipeUseCase
    ) {}

    public function __invoke(string $id): Response | JsonResponse
    {
        try {
            $pdf = $this->printRecipeUseCase->execute($id);
            return response($pdf->content, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $pdf->filename . '"',
            ]);
        } catch (RecipeNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 404);
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
