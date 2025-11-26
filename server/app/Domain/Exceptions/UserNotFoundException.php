<?php

namespace App\Domain\Exceptions;

use DomainException;

class UserNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Usuário não encontrado.");
    }
}
