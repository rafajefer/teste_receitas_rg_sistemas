<?php

namespace Tests\Unit\Application\UseCases\Auth;

use App\Application\DTOs\Auth\RegisterUserInputDTO;
use App\Application\DTOs\Auth\RegisterUserOutputDTO;
use App\Application\UseCases\Auth\RegisterUserUseCase;
use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Services\Hash\HashServiceInterface;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|UserRepositoryInterface */
    private UserRepositoryInterface $userRepo;

    /** @var \PHPUnit\Framework\MockObject\MockObject|HashServiceInterface */
    private HashServiceInterface $hashService;

    /** @var \PHPUnit\Framework\MockObject\MockObject|RegisterUserUseCase */
    private RegisterUserUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepo = $this->createMock(UserRepositoryInterface::class);
        $this->hashService = $this->createMock(HashServiceInterface::class);

        $this->useCase = new RegisterUserUseCase(
            userRepo: $this->userRepo,
            hashService: $this->hashService
        );
    }

    public function test_it_should_register_user_and_return_output_dto(): void
    {
        $input = new RegisterUserInputDTO(
            name: 'Rafael',
            login: 'rafael',
            password: '123456'
        );

        $hashedPassword = 'hashed-password';

        $userEntity = new UserEntity(
            id: 1,
            name: 'Rafael',
            login: 'rafael',
            password: $hashedPassword
        );

        $this->hashService
            ->method('make')
            ->with('123456')
            ->willReturn($hashedPassword);

        $this->userRepo
            ->method('create')
            ->with($this->callback(function ($entity) use ($userEntity) {
                return $entity->name === $userEntity->name &&
                       $entity->login === $userEntity->login &&
                       $entity->password === $userEntity->password;
            }))
            ->willReturn($userEntity);

        $result = $this->useCase->execute($input);

        $this->assertInstanceOf(RegisterUserOutputDTO::class, $result);
        $this->assertEquals(1, $result->id);
        $this->assertEquals('Rafael', $result->name);
        $this->assertEquals('rafael', $result->login);
    }
}