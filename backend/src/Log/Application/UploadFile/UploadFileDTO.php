<?php

namespace ufirst\Log\Application\UploadFile;


use Symfony\Component\Validator\Constraints as Assert;

final readonly class UploadFileDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public string $content
    )
    {
    }
}