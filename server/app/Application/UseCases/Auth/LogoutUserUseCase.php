<?php

namespace App\Application\UseCases\Auth;

use App\Models\Usuario;

final class LogoutUserUseCase
{
    public function execute(Usuario $usuario): bool
    {
        // remove apenas o token atual
        $usuario->currentAccessToken()?->delete();

        // ou para revogar todos:
        // $usuario->tokens()->delete();

        return true;
    }
}