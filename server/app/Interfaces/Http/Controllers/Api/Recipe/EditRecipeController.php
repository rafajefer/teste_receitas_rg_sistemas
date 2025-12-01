<?php

namespace App\Interfaces\Http\Controllers\Api\Recipe;

use App\Application\DTOs\Recipe\EditRecipeInputDTO;
use App\Application\UseCases\Recipe\EditRecipeUseCaseInterface;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Recipe\EditRecipeRequest;
use Illuminate\Http\JsonResponse;
/**
 * @OA\Put(
 *    path="/api/recipes/{id}",
 *    summary="Atualiza uma receita",
 *    tags={"Receitas"},
 *    security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
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
 *                 "title": "Bolo de Cenoura modificado",
 *                 "description": "Um bolo clássico, fofinho e delicioso.",
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
 *         description="Receita atualizada",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="string", example="1"),
 *             @OA\Property(property="title", type="string", example="Bolo de Cenoura modificado"),
 *             @OA\Property(property="preparationTimeMinutes", type="integer", example=null),
 *             @OA\Property(property="servings", type="integer", example=10),
 *             @OA\Property(property="ingredients", type="array", @OA\Items(type="string")),
 *             @OA\Property(property="steps", type="array", @OA\Items(type="string")),
 *             @OA\Property(property="user_id", type="string", example="1"),
 *             @OA\Property(property="category_id", type="integer", example=null),
 *             example={
 *                 "id": "1",
 *                 "title": "Bolo de Cenoura modificado",
 *                 "preparationTimeMinutes": null,
 *                 "servings": 10,
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
 *                 "user_id": "1",
 *                 "category_id": null
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
final class EditRecipeController extends Controller
{
    public function __construct(
        private EditRecipeUseCaseInterface $useCase
    ) {}

    public function __invoke(string $id, EditRecipeRequest $request): JsonResponse
    {
        $dto = new EditRecipeInputDTO(
            id: $id,
            title: $request->validated('title'),
            preparationTimeMinutes: $request->validated('preparationTimeMinutes'),
            servings: $request->validated('servings'),
            ingredients: $request->validated('ingredients'),
            steps: $request->validated('steps'),
            categoryId: $request->validated('category_id')
        );
        $recipe = $this->useCase->execute($dto);
        return response()->json($recipe);
    }
}
