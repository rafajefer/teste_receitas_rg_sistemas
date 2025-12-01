<?php

namespace App\Domain\Exceptions;

use DomainException;

class RecipeNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Receita não encontrada.");
    }
}
