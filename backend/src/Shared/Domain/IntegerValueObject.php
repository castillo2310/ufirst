<?php

namespace ufirst\Shared\Domain;

abstract readonly class IntegerValueObject implements ValueObject
{
    public function __construct(
        protected int $value
    )
    {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}