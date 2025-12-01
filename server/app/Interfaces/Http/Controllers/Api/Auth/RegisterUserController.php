<?php

namespace App\Interfaces\Http\Controllers\Api\Auth;
/**
 * @OA\Post(
 *     path="/api/auth/register",
 *     summary="Registrar novo usuário",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "login", "password"},
 *             @OA\Property(property="name", type="string", example="Nome do Usuário"),
 *             @OA\Property(property="login", type="string", example="usuarioteste"),
 *             @OA\Property(property="password", type="string", example="senha123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuário registrado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="string", example="9"),
 *             @OA\Property(property="name", type="string", example="Novo Usuário"),
 *             @OA\Property(property="login", type="string", example="usuarioteste")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Erro de domínio",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Erro de domínio: ...")
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

use App\Application\DTOs\Auth\RegisterUserInputDTO;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Auth\RegisterRequest;
use App\Application\UseCases\Auth\RegisterUserUseCase;
use Illuminate\Http\JsonResponse;

final class RegisterUserController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterUserUseCase $useCase): JsonResponse
    {
        try {
            $inputDTO = new RegisterUserInputDTO(
                name: $request->name,
                login: $request->login,
                password: $request->password,
            );

            $output = $useCase->execute($inputDTO);
            return response()->json($output, 201);
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
