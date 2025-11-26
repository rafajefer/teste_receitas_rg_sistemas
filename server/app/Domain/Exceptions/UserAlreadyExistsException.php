<?php

namespace App\Domain\Exceptions;

use DomainException;

class UserAlreadyExistsException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Usuário já existe.");
    }
}
