<?php

namespace ufirst\Log\Application\CreateLog;


use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateLogDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public string $content
    )
    {
    }
}