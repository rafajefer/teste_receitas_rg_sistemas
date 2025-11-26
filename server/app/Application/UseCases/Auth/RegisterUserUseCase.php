<?php

namespace App\Application\UseCases\Auth;

use App\DTOs\Auth\RegisterInput;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

final class RegisterUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepo) {}

    /**
     * @return array{user:\App\Models\User, token:string}
     */
    public function execute(RegisterInput $input): array
    {
        $now = Carbon::now();

        $user = $this->userRepo->create([
            'name' => $input->name,
            'login' => $input->login,
            'password' => Hash::make($input->password),
            'criado_em' => $now,
            'alterado_em' => $now,
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}