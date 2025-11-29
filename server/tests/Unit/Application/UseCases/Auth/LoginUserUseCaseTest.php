<?php

namespace Tests\Unit\Application\UseCases\Auth;

use App\Application\DTOs\Auth\LoginInputDTO;
use App\Application\DTOs\Auth\LoginOutputDTO;
use App\Application\UseCases\Auth\LoginUserUseCase;
use App\Domain\Entities\UserEntity;
use App\Domain\Exceptions\InvalidCredentialsException;
use App\Domain\Exceptions\UserNotFoundException;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Services\Hash\HashServiceInterface;
use App\Domain\Services\Token\TokenServiceInterface;
use PHPUnit\Framework\TestCase;

class LoginUserUseCaseTest extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject|UserRepositoryInterface */
    private UserRepositoryInterface $userRepo;

    /** @var \PHPUnit\Framework\MockObject\MockObject|HashServiceInterface */
    private HashServiceInterface $hashService;

    /** @var \PHPUnit\Framework\MockObject\MockObject|TokenServiceInterface */
    private TokenServiceInterface $tokenService;

    private LoginUserUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepo = $this->createMock(UserRepositoryInterface::class);
        $this->hashService = $this->createMock(HashServiceInterface::class);
        $this->tokenService = $this->createMock(TokenServiceInterface::class);

        $this->useCase = new LoginUserUseCase(
            userRepo: $this->userRepo,
            hashService: $this->hashService,
            tokenService: $this->tokenService
        );
    }

    public function test_it_should_login_user_with_valid_credentials(): void
    {
        $input = new LoginInputDTO(
            login: 'rafael',
            password: '123456'
        );

        $user = new UserEntity(
            id: 1,
            name: 'Rafael',
            login: 'rafael',
            password: 'hashed-password'
        );

        $this->userRepo
            ->method('findByLogin')
            ->with('rafael')
            ->willReturn($user);

        $this->hashService
            ->method('check')
            ->with('123456', 'hashed-password')
            ->willReturn(true);

        $result = $this->useCase->execute($input);

        $this->assertInstanceOf(LoginOutputDTO::class, $result);
        $this->assertIsString($result->accessToken);
    }

    public function test_it_should_throw_exception_when_password_is_invalid(): void
    {
        $input = new LoginInputDTO(
            login: 'rafael',
            password: 'wrong-pass'
        );

        $user = new UserEntity(
            id: 1,
            name: 'Rafael',
            login: 'rafael',
            password: 'hashed-password'
        );

        $this->userRepo
            ->method('findByLogin')
            ->willReturn($user);

        $this->hashService
            ->method('check')
            ->willReturn(false);

        $this->expectException(InvalidCredentialsException::class);

        $this->useCase->execute($input);
    }

    public function test_it_should_throw_exception_when_user_does_not_exist(): void
    {
        $input = new LoginInputDTO(
            login: 'rafael',
            password: '123'
        );

        $this->userRepo
            ->method('findByLogin')
            ->with('rafael')
            ->willThrowException(new UserNotFoundException());

        $this->expectException(UserNotFoundException::class);

        $this->useCase->execute($input);
    }
}
