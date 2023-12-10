<?php

namespace ufirst\Shared\Domain;

abstract readonly class IntegerValueObject
{
    public function __construct(
        protected int $value
    )
    {
    }

    public function value(): int
    {
        return $this->value;
    }
}