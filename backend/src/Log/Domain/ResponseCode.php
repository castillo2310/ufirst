<?php

namespace ufirst\Log\Domain;

use ufirst\Log\Domain\Exception\ResponseCodeInvalidException;
use ufirst\Shared\Domain\IntegerValueObject;

readonly class ResponseCode extends IntegerValueObject
{
    public function __construct(int $value)
    {
        $this->validate($value);

        parent::__construct($value);
    }

    private function validate(int $value): void
    {
        if ($value < 100 || $value > 599) {
            throw new ResponseCodeInvalidException();
        }
    }
}