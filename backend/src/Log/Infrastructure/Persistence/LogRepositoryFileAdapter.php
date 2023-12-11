<?php

namespace ufirst\Log\Infrastructure\Persistence;

use ufirst\Log\Domain\Exception\LogRepositoryException;
use ufirst\Log\Domain\Log;
use ufirst\Log\Domain\LogRepository;
use ufirst\Shared\Domain\JsonSerializer;

final class LogRepositoryFileAdapter implements LogRepository
{
    private bool $isFirstEntry = true;

    public function __construct(
        private readonly string $filePath,
        private readonly JsonSerializer $serializer
    )
    {
    }

    public function save(Log $log): void
    {
        try {
            $data = $this->serializer->serialize($log);
            $prefix = $this->isFirstEntry ? '' : ',';
            $this->isFirstEntry = false;

            file_put_contents($this->filePath, $prefix.$data, FILE_APPEND);
        } catch (\Exception $exception) {
            throw new LogRepositoryException($exception->getMessage());
        }
    }

    public function finalize(): void
    {
        try {
            file_put_contents($this->filePath, ']', FILE_APPEND);
        } catch (\Exception $exception) {
            throw new LogRepositoryException($exception->getMessage());
        }
    }

    public function get(): string
    {
        try {
            return file_get_contents($this->filePath);
        } catch (\Exception $exception) {
            throw new LogRepositoryException($exception->getMessage());
        }
    }

    public function initialize(): void
    {
        try {
            file_put_contents($this->filePath, '[');
        } catch (\Exception $exception) {
            throw new LogRepositoryException($exception->getMessage());
        }
    }
}