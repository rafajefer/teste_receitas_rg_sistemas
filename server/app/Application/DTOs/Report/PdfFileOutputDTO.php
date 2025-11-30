<?php

namespace App\Application\DTOs\Report;

final class PdfFileOutputDTO
{
    public function __construct(
        public string $content,
        public string $filename
    ) {}
}
