<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\Auth\{ LoginInputDTO, LoginOutputDTO };
use App\Domain\Exceptions\InvalidCredentialsException;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Services\Hash\HashServiceInterface;
use App\Domain\Services\Token\TokenServiceInterface;

final class LoginUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepo,
        private HashServiceInterface $hashService,
        private TokenServiceInterface $tokenService
    ) {}

    public function execute(LoginInputDTO $input): LoginOutputDTO
    {
        $user = $this->userRepo->findByLogin($input->login);
        if (!$user || !$this->hashService->check($input->password, $user->password)) {
            throw new InvalidCredentialsException();
        }

        $token = $this->tokenService->generate($user->id);

        return new LoginOutputDTO(
            accessToken: $token
        );
    }
}