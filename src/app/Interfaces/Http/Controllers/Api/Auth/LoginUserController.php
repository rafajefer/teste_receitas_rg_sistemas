<?php

namespace App\Interfaces\Http\Controllers\Api\Auth;

use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Auth\LoginRequest;
use App\Application\DTOs\Auth\LoginInputDTO;
use App\Application\UseCases\Auth\LoginUserUseCase;
use App\Domain\Exceptions\InvalidCredentialsException;

final class LoginUserController extends Controller
{
    public function __invoke(LoginRequest $request, LoginUserUseCase $useCase)
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
        }
    }
}
