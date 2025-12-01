<?php

namespace App\Interfaces\Http\Controllers\Api\Auth;
/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="Login do usuário",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"login", "password"},
 *             @OA\Property(property="login", type="string", example="admin"),
 *             @OA\Property(property="password", type="string", example="123456")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Login realizado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="accessToken", type="string", example="50|fgBpARSV1N0sMg5cPwbM0p8p35xw7cEEs93IwWNk346b4ca8")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Credenciais inválidas",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Credenciais inválidas")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno do servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Erro interno do servidor.")
 *         )
 *     )
 * )
 */

use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Auth\LoginRequest;
use App\Application\DTOs\Auth\LoginInputDTO;
use App\Application\UseCases\Auth\LoginUserUseCase;
use App\Domain\Exceptions\InvalidCredentialsException;
use Illuminate\Http\JsonResponse;

final class LoginUserController extends Controller
{
    public function __invoke(LoginRequest $request, LoginUserUseCase $useCase): JsonResponse
    {
        try {
            $inputDTO = new LoginInputDTO(
                login: $request->login,
                password: $request->password,
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
                'error' => 'Erro interno do servidor.',
            ], 500);
        }
    }
}
