<?php

namespace ufirst\Shared\Domain;


abstract readonly class StringValueObject
{
    public function __construct(
        protected string $value
    )
    {
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}