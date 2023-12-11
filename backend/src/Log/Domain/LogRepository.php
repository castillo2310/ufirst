<?php

namespace ufirst\Log\Domain;

interface LogRepository
{
    public function save(Log $log): void;
    public function finalize(): void;
    public function get(): string;
    public function initialize(): void;
}