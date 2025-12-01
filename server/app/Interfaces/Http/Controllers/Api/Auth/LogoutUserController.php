<?php

namespace App\Interfaces\Http\Controllers\Api\Auth;

use App\Application\UseCases\Auth\LogoutUserUseCase;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/auth/logout",
 *     summary="Logout do usuário autenticado",
 *     tags={"Auth"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Logout realizado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Logout realizado com sucesso")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autenticado",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Não autenticado")
 *         )
 *     )
 * )
 */


class LogoutUserController
{
    public function __invoke(LogoutUserUseCase $useCase): JsonResponse
    {
        $tokenId = auth('sanctum')->user()?->currentAccessToken()?->id;
        $useCase->execute($tokenId);
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
