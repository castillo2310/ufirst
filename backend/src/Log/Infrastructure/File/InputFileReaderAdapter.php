<?php

namespace ufirst\Log\Infrastructure\File;

use ufirst\Log\Domain\Exception\InputFileReaderException;
use ufirst\Log\Domain\InputFileReader;

class InputFileReaderAdapter implements InputFileReader
{
    private $resource;

    public function open(string $content): void
    {
        try {
            $decodedContent = base64_decode($content);
            $this->resource = fopen('php://memory', 'r+');
            fwrite($this->resource, $decodedContent);
            rewind($this->resource);
        } catch (\Exception $exception) {
            throw new InputFileReaderException($exception->getMessage());
        }
    }

    public function readLine(): ?string
    {
        try {
            if (!$this->resource) {
                return null;
            }

            if (($line = fgets($this->resource)) !== false) {
                return $line;
            }

            return null;
        } catch (\Exception $exception) {
            throw new InputFileReaderException($exception->getMessage());
        }
    }

    public function close(): void
    {
        try {
            if ($this->resource) {
                fclose($this->resource);
            }
        } catch (\Exception $exception) {
            throw new InputFileReaderException($exception->getMessage());
        }
    }
}