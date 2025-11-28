<?php

namespace App\Domain\Services;

interface RecipeExportGeneratorInterface
{
    /**
     * Gera arquivo de exportação (PDF, CSV, etc) para uma receita.
     * @param mixed $data Dados da receita (DTO ou array)
     * @param string $filename Nome do arquivo gerado
     * @return object DTO do arquivo gerado (PdfFileDTO, CsvFileDTO, etc)
     */
    public function generate($data, string $filename);
}
