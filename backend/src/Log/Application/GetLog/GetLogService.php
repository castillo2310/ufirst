<?php

namespace ufirst\Log\Application\GetLog;

use ufirst\Log\Domain\LogRepository;

final readonly class GetLogService
{
    public function __construct(
        private LogRepository $logRepository
    )
    {
    }

    public function __invoke(): string
    {
        return $this->logRepository->get();
    }
}