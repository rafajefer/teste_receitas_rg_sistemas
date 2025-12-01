<?php

namespace App\Interfaces\Http\Controllers\Api\Auth;

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

use App\Interfaces\Http\Controllers\Controller;
use App\Application\UseCases\Auth\LogoutUserUseCase;
use Illuminate\Http\JsonResponse;

final class LogoutUserController extends Controller
{
    public function __invoke(LogoutUserUseCase $useCase): JsonResponse
    {
        try {
            $tokenId = auth('sanctum')->user()?->currentAccessToken()?->id;
            $useCase->execute($tokenId);
            return response()->json(['message' => 'Logout realizado com sucesso']);
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
