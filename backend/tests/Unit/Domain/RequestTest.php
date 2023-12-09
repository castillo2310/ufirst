<?php

namespace ufirst\tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Domain\Request;
use ufirst\Log\Domain\RequestMethod;
use ufirst\Log\Domain\RequestProtocol;
use ufirst\Log\Domain\RequestUrl;

class RequestTest extends TestCase
{
    public function testShouldReturnRequest(): void
    {
        $lineString = '"GET /Consumer.html HTTP/1.0"';

        $request = Request::fromLogString($lineString);

        $assertRequest = new Request(
            RequestMethod::GET,
            new RequestUrl('/Consumer.html'),
            new RequestProtocol('HTTP/1.0')
        );

        $this->assertEquals($assertRequest, $request);
    }
}