<?php

namespace ufirst\tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Domain\Exception\LogDateTimeInvalidDayException;
use ufirst\Log\Domain\Exception\LogDateTimeInvalidFormatException;
use ufirst\Log\Domain\LogDateTime;

class LogDateTimeTest extends TestCase
{
    public function testShouldReturnCorrectLogDateTime(): void
    {
        $lineString = '[29:23:53:25]';

        $logDateTime = LogDateTime::fromLogString($lineString);

        $assertLogDateTime = new LogDateTime('1995-08-29 23:53:25');

        $this->assertEquals($assertLogDateTime, $logDateTime);
    }

    public function testShouldThrowExceptionWhenInvalidDateFormatWithoutDay(): void
    {
        $this->expectException(LogDateTimeInvalidFormatException::class);

        $lineString = '[23:53:25]';

        $logDateTime = LogDateTime::fromLogString($lineString);
    }

    public function testShouldThrowExceptionWhenInvalidDateFormatWithWrongDay(): void
    {
        $this->expectException(LogDateTimeInvalidDayException::class);

        $lineString = '[44:23:53:25]';

        $logDateTime = LogDateTime::fromLogString($lineString);
    }

    public function testShouldThrowExceptionWhenInvalidDateFormat(): void
    {
        $this->expectException(LogDateTimeInvalidFormatException::class);

        $lineString = '[29:23:53:-25]';

        $logDateTime = LogDateTime::fromLogString($lineString);
    }
}