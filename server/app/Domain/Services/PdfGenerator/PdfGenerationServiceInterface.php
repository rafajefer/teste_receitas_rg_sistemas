<?php

namespace App\Domain\Services\PdfGenerator;

use App\Application\DTOs\Report\PdfFileDTO;

interface PdfGenerationServiceInterface
{
    /**
     * Gera o PDF e retorna o conteúdo binário e nome do arquivo.
     */
    public function generate(array $data, string $view, string $filename): PdfFileDTO;
}