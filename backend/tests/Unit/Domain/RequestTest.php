<?php

namespace ufirst\tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Domain\Request;
use ufirst\Log\Domain\RequestMethod;
use ufirst\Log\Domain\RequestProtocol;
use ufirst\Log\Domain\RequestProtocolVersion;
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
            RequestProtocol::HTTP,
            RequestProtocolVersion::ONE
        );

        $this->assertEquals($assertRequest, $request);
    }

    public function testShouldReturnRequestWhenNoMethodAndNoProtocol(): void
    {
        $lineString = '"cons/circle_logo_small.gif"';

        $request = Request::fromLogString($lineString);

        $assertRequest = new Request(
            null,
            new RequestUrl('cons/circle_logo_small.gif'),
            null,
            null
        );

        $this->assertEquals($assertRequest, $request);
    }
    public function testShouldReturnRequestWhenUrlHasBlankSpacesAndNoProtocol(): void
    {
        $lineString = '"GET /docs/Access/chapter6/s6-2.html>Andrew W. Breidenbach Environmental"';

        $request = Request::fromLogString($lineString);

        $assertRequest = new Request(
            RequestMethod::GET,
            new RequestUrl('/docs/Access/chapter6/s6-2.html>Andrew W. Breidenbach Environmental'),
            null,
            null
        );

        $this->assertEquals($assertRequest, $request);
    }
    public function testShouldReturnRequestWhenNoProtocol(): void
    {
        $lineString = '"GET /icons/circle_logo_small.gif"';

        $request = Request::fromLogString($lineString);

        $assertRequest = new Request(
            RequestMethod::GET,
            new RequestUrl('/icons/circle_logo_small.gif'),
            null,
            null
        );

        $this->assertEquals($assertRequest, $request);
    }
}