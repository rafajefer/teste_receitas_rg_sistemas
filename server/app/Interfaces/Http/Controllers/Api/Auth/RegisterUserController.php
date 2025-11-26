<?php

namespace App\Interfaces\Http\Controllers\Api\Auth;

use App\Application\DTOs\Auth\RegisterUserInputDTO;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Auth\RegisterRequest;
use App\Application\UseCases\Auth\RegisterUserUseCase;

final class RegisterUserController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterUserUseCase $useCase)
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
