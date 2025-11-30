<?php

namespace App\Infrastructure\Services\PdfGenerator;

use App\Application\DTOs\Report\PdfFileOutputDTO;
use App\Domain\Services\PdfGenerator\PdfGenerationServiceInterface;
use Barryvdh\DomPDF\Facade\Pdf;

class DomPdfGeneratorService implements PdfGenerationServiceInterface
{
    public function generate(array $data, string $view, string $filename): PdfFileOutputDTO
    {
        $pdf = Pdf::loadView($view, $data);
        $content = $pdf->output();
        return new PdfFileOutputDTO($content, $filename);
    }
}
