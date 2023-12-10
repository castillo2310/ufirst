<?php

namespace ufirst\Shared\Domain;


abstract readonly class StringValueObject implements ValueObject
{
    public function __construct(
        protected string $value
    )
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}