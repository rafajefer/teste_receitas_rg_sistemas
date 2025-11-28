<?php

namespace App\Domain\Services;

use App\Application\DTOs\Report\PdfFileDTO;
use App\Domain\Services\PdfGenerator\PdfGenerationServiceInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class RecipePdfGeneratorService implements PdfGenerationServiceInterface
{
    public function generate(array $data, string $view, string $filename): PdfFileDTO
    {
        $pdf = Pdf::loadView($view, $data);
        $content = $pdf->output();
        return new PdfFileDTO($content, $filename);
    }
}
