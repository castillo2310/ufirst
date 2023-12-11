<?php

namespace Unit\Application;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Application\GetLog\GetLogService;
use ufirst\Log\Domain\Exception\LogRepositoryException;
use ufirst\Log\Domain\LogRepository;

class GetLogServiceTest extends TestCase
{
    private LogRepository $logRepository;
    private GetLogService $service;

    protected function setUp(): void
    {
        $this->logRepository = $this->createMock(LogRepository::class);

        $this->service = new GetLogService($this->logRepository);
    }

    public function testShouldReturnLogContent(): void
    {
        $content = 'fileContent';

        $this->logRepository
            ->expects($this->once())
            ->method('get')
            ->willReturn($content);

        $response = $this->service->__invoke();

        $this->assertEquals($content, $response);
    }

    public function testShouldThrowExceptionWhenLogRepositoryException(): void
    {
        $this->expectException(LogRepositoryException::class);

        $this->logRepository
            ->expects($this->once())
            ->method('get')
            ->willThrowException(new LogRepositoryException());

        $response = $this->service->__invoke();
    }
}