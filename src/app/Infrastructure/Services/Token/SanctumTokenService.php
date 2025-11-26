<?php

namespace App\Infrastructure\Services\Token;

use App\Domain\Services\Token\TokenServiceInterface;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;

final class SanctumTokenService implements TokenServiceInterface
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function generate(int $userId): string
    {
        $user = $this->userModel->find($userId);
        return $user->createToken('auth')->plainTextToken;
    }
}