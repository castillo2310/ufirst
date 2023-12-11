<?php

namespace ufirst\Log\Application\CreateLog;

use ufirst\Log\Domain\InputFileReader;
use ufirst\Log\Domain\LogCreator;
use ufirst\Log\Domain\LogRepository;

final readonly class CreateLogService
{
    public function __construct(
        private LogCreator $logCreator,
        private LogRepository $logRepository,
        private InputFileReader $inputFileReader
    )
    {
    }

    public function __invoke(CreateLogDTO $createLogDTO): void
    {
        try {
            $this->inputFileReader->open($createLogDTO->content);

            $this->logRepository->initialize();
            while ($line = $this->inputFileReader->readLine()) {
                $log = $this->logCreator->fromLine($line);
                $this->logRepository->save($log);
            }
            $this->logRepository->finalize();
        } finally {
            $this->inputFileReader->close();
        }
    }
}