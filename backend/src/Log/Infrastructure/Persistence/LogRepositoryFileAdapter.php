<?php

namespace ufirst\Log\Infrastructure\Persistence;

use Symfony\Component\Serializer\SerializerInterface;
use ufirst\Log\Domain\Exception\LogRepositoryException;
use ufirst\Log\Domain\Log;
use ufirst\Log\Domain\LogRepository;

final readonly class LogRepositoryFileAdapter implements LogRepository
{
    public function __construct(
        private string $filePath,
        private SerializerInterface $serializer
    )
    {
        $this->initFile();
    }

    private function initFile(): void
    {
        if (file_exists($this->filePath)) {
            file_put_contents($this->filePath, '');
        }
    }

    public function save(Log $log): void
    {
        try {
            $data = $this->serializer->serialize($log, 'json');
            file_put_contents($this->filePath, $data, FILE_APPEND);
        } catch (\Exception $exception) {
            throw new LogRepositoryException($exception->getMessage());
        }
    }
}