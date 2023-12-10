<?php

namespace ufirst\Shared\Domain;

interface JsonSerializer
{
    public function serialize(mixed $data): string;
}