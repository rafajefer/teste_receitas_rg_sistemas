<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\DTOs\Recipe\ListRecipesFilterInputDTO;
use App\Application\UseCases\Recipe\ListRecipesUseCaseInterface;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Recipe\ListRecipeRequest;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Get(
 *     path="/api/recipes",
 *     summary="Lista todas as receitas",
 *     tags={"Receitas"},
 *     security={{"sanctum":{}}},
 *      @OA\Parameter(
 *         name="title",
 *         in="query",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de receitas",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="string", example="1"),
 *                 @OA\Property(property="title", type="string", example="Bolo de Cenoura"),
 *                 @OA\Property(property="preparationTimeMinutes", type="integer", example=60),
 *                 @OA\Property(property="servings", type="integer", example=10),
 *                 @OA\Property(property="ingredients", type="array", @OA\Items(type="string")),
 *                 @OA\Property(property="steps", type="array", @OA\Items(type="string")),
 *                 @OA\Property(property="userId", type="string", example="1"),
 *                 @OA\Property(property="userName", type="string", example="Administrador"),
 *                 @OA\Property(property="categoryId", type="string", example=null),
 *                 @OA\Property(property="categoryName", type="string", example=null)
 *             ),
 *             example={
 *                 {
 *                     "id": "1",
 *                     "title": "Bolo de Cenoura",
 *                     "preparationTimeMinutes": 60,
 *                     "servings": 10,
 *                     "ingredients": {
 *                         "3 cenouras médias raladas",
 *                         "4 ovos",
 *                         "1 xícara de óleo",
 *                         "2 xícaras de açúcar",
 *                         "2 e 1/2 xícaras de farinha de trigo",
 *                         "1 colher de sopa de fermento em pó"
 *                     },
 *                     "steps": {
 *                         "Bata no liquidificador as cenouras, ovos e óleo.",
 *                         "Adicione o açúcar e bata novamente.",
 *                         "Misture a farinha e o fermento em uma tigela e acrescente a mistura do liquidificador.",
 *                         "Despeje em uma forma untada e asse em forno médio por 40 minutos."
 *                     },
 *                     "userId": "1",
 *                     "userName": "Administrador",
 *                     "categoryId": "1",
 *                     "categoryName": "Bolos e tortas doces"
 *                 },
 *                 {
 *                     "id": "2",
 *                     "title": "Pudim de Leite Condensado",
 *                     "preparationTimeMinutes": 90,
 *                     "servings": 8,
 *                     "ingredients": {
 *                         "1 lata de leite condensado",
 *                         "2 latas de leite (medida da lata de leite condensado)",
 *                         "3 ovos",
 *                         "1 xícara de açúcar (para o caramelo)"
 *                     },
 *                     "steps": {
 *                         "Faça o caramelo com o açúcar e espalhe na forma.",
 *                         "Bata os demais ingredientes no liquidificador.",
 *                         "Despeje na forma caramelizada.",
 *                         "Asse em banho-maria por cerca de 1h30."
 *                     },
 *                     "userId": "1",
 *                     "userName": "Administrador",
 *                     "categoryId": null,
 *                     "categoryName": null
 *                 }
 *             }
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
final class ListRecipeController extends Controller
{
    public function __invoke(ListRecipeRequest $request, ListRecipesUseCaseInterface $useCase): JsonResponse
    {
        try {
            $filter = new ListRecipesFilterInputDTO(
                title: $request->query('title')
            );
            $outputDTO = $useCase->execute($filter);
            return response()->json($outputDTO, 200);
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
