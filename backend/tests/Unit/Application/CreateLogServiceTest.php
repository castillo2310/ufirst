<?php

namespace ufirst\tests\Unit\Application;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Application\CreateLog\CreateLogDTO;
use ufirst\Log\Application\CreateLog\CreateLogService;
use ufirst\Log\Domain\Exception\InputFileReaderException;
use ufirst\Log\Domain\Exception\LogCreatorException;
use ufirst\Log\Domain\Exception\LogRepositoryException;
use ufirst\Log\Domain\InputFileReader;
use ufirst\Log\Domain\LogCreator;
use ufirst\Log\Domain\LogRepository;

class CreateLogServiceTest extends TestCase
{
    private LogCreator $logCreator;
    private LogRepository $logRepository;
    private InputFileReader $inputFileReader;
    private CreateLogDTO $dto;
    private CreateLogService $service;

    protected function setUp(): void
    {
        $this->logCreator = $this->createMock(LogCreator::class);
        $this->logRepository = $this->createMock(LogRepository::class);
        $this->inputFileReader = $this->createMock(InputFileReader::class);

        $this->dto = new CreateLogDTO('base64encodedfile');
        
        $this->service = new CreateLogService(
            $this->logCreator,
            $this->logRepository,
            $this->inputFileReader
        );
    }

    public function testShouldCreateLogWithSuccess(): void
    {
        $this->inputFileReader
            ->expects($this->once())
            ->method('open');

        $this->logRepository
            ->expects($this->once())
            ->method('initialize');

        $this->inputFileReader
            ->expects($this->exactly(3))
            ->method('readLine')
            ->willReturn('lineString1', 'lineString2', null);

        $this->logCreator
            ->expects($this->exactly(2))
            ->method('fromLine');

        $this->logRepository
            ->expects($this->exactly(2))
            ->method('save');

        $this->inputFileReader
            ->expects($this->once())
            ->method('close');

        $this->service->__invoke($this->dto);
    }

    public function testShouldThrowExceptionWhenOpenInputFileFails(): void
    {
        $this->expectException(InputFileReaderException::class);

        $this->inputFileReader
            ->expects($this->once())
            ->method('open')
            ->willThrowException(new InputFileReaderException());

        $this->logRepository
            ->expects($this->never())
            ->method('initialize');

        $this->inputFileReader
            ->expects($this->never())
            ->method('readLine');

        $this->logCreator
            ->expects($this->never())
            ->method('fromLine');

        $this->logRepository
            ->expects($this->never())
            ->method('save');

        $this->inputFileReader
            ->expects($this->once())
            ->method('close');

        $this->service->__invoke($this->dto);
    }

    public function testShouldThrowExceptionWhenLogCreatorFails(): void
    {
        $this->expectException(LogCreatorException::class);

        $this->inputFileReader
            ->expects($this->once())
            ->method('open');

        $this->logRepository
            ->expects($this->once())
            ->method('initialize');

        $this->inputFileReader
            ->expects($this->once())
            ->method('readLine')
            ->willReturn('lineString1');

        $this->logCreator
            ->expects($this->once())
            ->method('fromLine')
            ->willThrowException(new LogCreatorException());

        $this->logRepository
            ->expects($this->never())
            ->method('save');

        $this->inputFileReader
            ->expects($this->once())
            ->method('close');

        $this->service->__invoke($this->dto);
    }

    public function testShouldThrowExceptionWhenLogRepositoryFails(): void
    {
        $this->expectException(LogRepositoryException::class);

        $this->inputFileReader
            ->expects($this->once())
            ->method('open');

        $this->logRepository
            ->expects($this->once())
            ->method('initialize');

        $this->inputFileReader
            ->expects($this->once())
            ->method('readLine')
            ->willReturn('lineString1');

        $this->logCreator
            ->expects($this->once())
            ->method('fromLine');

        $this->logRepository
            ->expects($this->once())
            ->method('save')
            ->willThrowException(new LogRepositoryException());

        $this->inputFileReader
            ->expects($this->once())
            ->method('close');

        $this->service->__invoke($this->dto);
    }
}