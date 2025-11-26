<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\Auth\RegisterUserInputDTO;
use App\Application\DTOs\Auth\RegisterUserOutputDTO;
use App\Domain\Factories\UserFactory;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Services\Hash\HashServiceInterface;

final class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepo,
        private HashServiceInterface $hashService
    ) {}

    public function execute(RegisterUserInputDTO $input): RegisterUserOutputDTO
    {
        $userEntity = UserFactory::createFromArray([
            'name' => $input->name,
            'login' => $input->login,
            'password' => $this->hashService->make($input->password)
        ]);

        $user = $this->userRepo->create($userEntity);

        return new RegisterUserOutputDTO(
            id: $user->id,
            name: $user->name,
            login: $user->login
        );
    }
}