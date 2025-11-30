<?php

namespace Tests\Unit\Infrastructure\Services\Token;

use App\Infrastructure\Services\Token\SanctumTokenService;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;
use Tests\TestCase;
use Mockery;

class SanctumTokenServiceTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_generate_returns_token_string(): void
    {
        $userId = 1;

        $userMock = Mockery::mock();
        $userMock->shouldReceive('createToken')
            ->with('auth')
            ->andReturn((object)['plainTextToken' => 'token123']);

        $userModelMock = Mockery::mock(UserModel::class);
        $userModelMock->shouldReceive('find')
            ->with($userId)
            ->andReturn($userMock);

        $service = new SanctumTokenService($userModelMock);
        $token = $service->generate($userId);

        $this->assertEquals('token123', $token);
    }

    public function test_revoke_all_tokens_deletes_all_user_tokens(): void
    {
        $userId = 1;

        $tokensMock = Mockery::mock();
        $tokensMock->shouldReceive('delete')->once();

        $userMock = Mockery::mock();
        $userMock->shouldReceive('tokens')->andReturn($tokensMock);

        $userModelMock = Mockery::mock(UserModel::class);
        $userModelMock->shouldReceive('find')->with($userId)->andReturn($userMock);

        $service = new SanctumTokenService($userModelMock);

        $service->revokeAllTokens($userId);

        $this->assertTrue(true);
    }
}
