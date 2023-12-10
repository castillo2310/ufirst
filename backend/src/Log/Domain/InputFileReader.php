<?php

namespace ufirst\Log\Domain;

interface InputFileReader
{
    public function open(string $content): void;
    public function readLine(): ?string;
    public function close(): void;
}