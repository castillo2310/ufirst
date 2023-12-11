<?php

namespace ufirst\Log\Application\CreateLog;


use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateLogDTO
{
    public function __construct(
        #[Assert\NotNull(message: 'Content field should not be null.')]
        #[Assert\NotBlank(message: 'Content field should not be empty.')]
        public string $content
    )
    {
    }
}