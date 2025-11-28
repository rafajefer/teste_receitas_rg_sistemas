<?php

namespace App\Application\DTOs\Report;

final class PdfFileDTO
{
    public function __construct(
        public string $content,
        public string $filename
    ) {}
}
