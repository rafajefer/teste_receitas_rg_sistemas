<?php

namespace Tests\Unit\Domain\Exceptions;

use App\Domain\Exceptions\InvalidCredentialsException;
use PHPUnit\Framework\TestCase;

class InvalidCredentialsExceptionTest extends TestCase
{
    public function test_exception_message_is_correct(): void
    {
        $exception = new InvalidCredentialsException();
        $this->assertEquals('Credenciais inválidas.', $exception->getMessage());
    }

    public function test_exception_is_instance_of_domain_exception(): void
    {
        $exception = new InvalidCredentialsException();
        $this->assertInstanceOf(\DomainException::class, $exception);
    }
}
