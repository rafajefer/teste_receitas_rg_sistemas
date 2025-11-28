<?php

namespace App\Application\UseCases\Recipe;

interface DeleteRecipeUseCaseInterface
{
    public function execute(string $id): void;
}
