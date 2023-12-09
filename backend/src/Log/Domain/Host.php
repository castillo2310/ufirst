<?php

namespace ufirst\Log\Domain;


use ufirst\Log\Domain\Exception\HostInvalidFormatException;
use ufirst\Shared\Domain\StringValueObject;

readonly class Host extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->validate($value);

        parent::__construct($value);
    }

    private function validate(string $value): void
    {
        if (filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) !== false) {
            return;
        }

        throw new HostInvalidFormatException();
    }
}