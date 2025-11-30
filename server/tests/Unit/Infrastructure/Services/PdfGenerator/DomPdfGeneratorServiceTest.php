<?php

namespace Tests\Unit\Infrastructure\Services\PdfGenerator;

use App\Application\DTOs\Report\PdfFileOutputDTO;
use App\Infrastructure\Services\PdfGenerator\DomPdfGeneratorService;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdfClass;
use Mockery;
use Tests\TestCase;

class DomPdfGeneratorServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_generate_returns_pdf_file_output_dto(): void
    {
        $data = ['recipe' => ['title' => 'Bolo']];
        $view = 'recipes.print';
        $filename = 'recipe_1.pdf';
        $pdfContent = '%PDF-FAKE-BINARY%';

        // Mock da classe concreta DOMPDF
        $pdfMock = Mockery::mock(DomPdfClass::class)->makePartial();
        $pdfMock->shouldReceive('output')->andReturn($pdfContent);

        // Mock do Facade
        Pdf::shouldReceive('loadView')
            ->with($view, $data)
            ->andReturn($pdfMock);

        $service = new DomPdfGeneratorService();
        $result = $service->generate($data, $view, $filename);

        $this->assertInstanceOf(PdfFileOutputDTO::class, $result);
        $this->assertEquals($pdfContent, $result->content);
        $this->assertEquals($filename, $result->filename);
    }
}
