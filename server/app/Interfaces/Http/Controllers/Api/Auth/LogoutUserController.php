<?php

namespace App\Interfaces\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Application\UseCases\Auth\LogoutUserUseCase;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;

class LogoutUserController
{
    public function __invoke(Request $request, LogoutUserUseCase $useCase)
    {
        $tokenId = auth()->user()->currentAccessToken()?->id;
        $useCase->execute($tokenId);
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
