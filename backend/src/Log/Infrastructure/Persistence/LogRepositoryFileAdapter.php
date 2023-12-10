<?php

namespace ufirst\Log\Infrastructure\Persistence;

use Symfony\Component\Serializer\SerializerInterface;
use ufirst\Log\Domain\Exception\LogRepositoryException;
use ufirst\Log\Domain\Log;
use ufirst\Log\Domain\LogRepository;

final class LogRepositoryFileAdapter implements LogRepository
{
    private bool $isFirstEntry = true;

    public function __construct(
        private readonly string $filePath,
        private readonly SerializerInterface $serializer
    )
    {
        $this->initFile();
    }

    private function initFile(): void
    {
        if (file_exists($this->filePath)) {
            file_put_contents($this->filePath, '[');
        }
    }

    public function save(Log $log): void
    {
        try {
            $data = $this->serializer->serialize($log, 'json');
            $prefix = $this->isFirstEntry ? '' : ',';
            $this->isFirstEntry = false;

            file_put_contents($this->filePath, $prefix.$data, FILE_APPEND);
        } catch (\Exception $exception) {
            throw new LogRepositoryException($exception->getMessage());
        }
    }

    public function finalize(): void
    {
        file_put_contents($this->filePath, ']', FILE_APPEND);
    }
}