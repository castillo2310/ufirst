<?php

namespace ufirst\tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Domain\Exception\HostInvalidFormatException;
use ufirst\Log\Domain\Host;

class HostTest extends TestCase
{
    public function testShouldReturnCorrectHostWhenHostname(): void
    {
        $lineString = 'wpbfl2-45.gate.net';

        $host = new Host($lineString);

        $this->assertEquals($lineString, $host->value());
    }

    public function testShouldReturnCorrectHostWhenIpAddress(): void
    {
        $lineString = '140.112.68.165';

        $host = new Host($lineString);

        $this->assertEquals($lineString, $host->value());
    }

    public function testShouldThrowExceptionWhenInvalidIpAddress(): void
    {
        $this->expectException(HostInvalidFormatException::class);

        $lineString = '140.112.68_3';

        $host = new Host($lineString);
    }
}