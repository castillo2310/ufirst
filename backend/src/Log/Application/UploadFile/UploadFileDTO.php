<?php

namespace ufirst\Log\Application\UploadFile;

final readonly class UploadFileDTO
{
    public function __construct(
        public string $content
    )
    {
    }
}