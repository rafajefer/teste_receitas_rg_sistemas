<?php

namespace App\Application\UseCases;

interface DeleteRecipeUseCaseInterface
{
    public function execute(string $id): void;
}
