<?php

namespace App\Application\UseCases\Recipe;

use App\Application\DTOs\Report\PdfFileOutputDTO;

interface PrintRecipeUseCaseInterface
{
    public function execute(string $id): PdfFileOutputDTO;
}
