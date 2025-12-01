<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\DTOs\Recipe\CreateRecipeInputDTO;
use App\Application\UseCases\Recipe\CreateRecipeUseCase;
use App\Domain\Exceptions\InvalidCredentialsException;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Recipe\CreateRecipeRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *    path="/api/recipes",
 *    summary="Cria uma nova receita",
 *    tags={"Receitas"},
 *    security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "category_id"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="preparation_time_minutes", type="integer"),
 *             @OA\Property(property="servings", type="integer"),
 *             @OA\Property(property="ingredients", type="array", @OA\Items(type="string")),
 *             @OA\Property(property="steps", type="array", @OA\Items(type="string")),
 *             @OA\Property(property="category_id", type="integer"),
 *             example={
 *                 "title": "Novo Bolo de Cenoura",
 *                 "description": "Um bolo clássico, fofinho, delicioso e bem colorido.",
 *                 "ingredients": {
 *                     "3 cenouras médias raladas",
 *                     "4 ovos",
 *                     "1 xícara de óleo",
 *                     "2 xícaras de açúcar",
 *                     "2 e 1/2 xícaras de farinha de trigo",
 *                     "1 colher de sopa de fermento em pó"
 *                 },
 *                 "steps": {
 *                     "Bata no liquidificador as cenouras, ovos e óleo.",
 *                     "Adicione o açúcar e bata novamente.",
 *                     "Misture a farinha e o fermento em uma tigela e acrescente a mistura do liquidificador.",
 *                     "Despeje em uma forma untada e asse em forno médio por 40 minutos."
 *                 },
 *                 "preparation_time_minutes": 60,
 *                 "servings": 10,
 *                 "category_id": null
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *        description="Receita criada"
 *    ),
 *    @OA\Response(
 *        response=401,
 *        description="Não autenticado",
 *        @OA\JsonContent(
 *            @OA\Property(property="error", type="string", example="Unauthenticated.")
 *        )
 *    )
 *)
 */
class CreateRecipeController extends Controller
{
    public function __invoke(CreateRecipeRequest $request, CreateRecipeUseCase $useCase): JsonResponse
    {
        try {
            $inputDTO = new CreateRecipeInputDTO(
                title: $request->title,
                preparationTimeMinutes: $request->preparationTimeMinutes,
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
