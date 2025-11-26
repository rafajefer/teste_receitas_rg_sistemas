<?php

namespace App\Domain\Exceptions;

use DomainException;

class InvalidCredentialsException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Credenciais inválidas.");
    }
}