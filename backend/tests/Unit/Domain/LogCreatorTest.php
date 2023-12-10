<?php

namespace ufirst\tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Domain\DocumentSize;
use ufirst\Log\Domain\Exception\LogCreatorException;
use ufirst\Log\Domain\Host;
use ufirst\Log\Domain\Log;
use ufirst\Log\Domain\LogCreator;
use ufirst\Log\Domain\LogDateTime;
use ufirst\Log\Domain\Request;
use ufirst\Log\Domain\RequestMethod;
use ufirst\Log\Domain\RequestProtocol;
use ufirst\Log\Domain\RequestUrl;
use ufirst\Log\Domain\ResponseCode;


class LogCreatorTest extends TestCase
{
    private LogCreator $logCreator;
    
    protected function setUp(): void
    {
        $this->logCreator = new LogCreator();
    }

    public function testShouldReturnCompleteLog(): void
    {
        $lineString = 'query2.lycos.cs.cmu.edu [29:23:53:36] "GET /Consumer.html HTTP/1.0" 200 1325';

        $log = $this->logCreator->fromLine($lineString);

        $assertLog = new Log(
            new Host('query2.lycos.cs.cmu.edu'),
            new LogDateTime('1995-08-29 23:53:36'),
            new Request(
                RequestMethod::GET,
                new RequestUrl('/Consumer.html'),
                RequestProtocol::HTTP1,
            ),
            new ResponseCode(200),
            new DocumentSize(1325)
        );

        $this->assertEquals($assertLog, $log);
    }

    public function testShouldReturnIncompleteWithBlankSpacesRequestLog(): void
    {
        $lineString = 'lab7.pc.fsu.edu [30:13:52:03] "GET /docs/Access/chapter6/s5-2.html>Library Services Office," 404 -';

        $log = $this->logCreator->fromLine($lineString);

        $assertLog = new Log(
            new Host('lab7.pc.fsu.edu'),
            new LogDateTime('1995-08-30 13:52:03'),
            new Request(
                RequestMethod::GET,
                new RequestUrl('/docs/Access/chapter6/s5-2.html>Library Services Office,'),
                null,
            ),
            new ResponseCode(404),
            null
        );

        $this->assertEquals($assertLog, $log);
    }

    public function testShouldReturnIncompleteRequestLog(): void
    {
        $lineString = 'willard-ibmpc12.cac-labs.psu.edu [30:15:17:13] "ogos/us-flag.gif" 400';

        $log = $this->logCreator->fromLine($lineString);

        $assertLog = new Log(
            new Host('willard-ibmpc12.cac-labs.psu.edu'),
            new LogDateTime('1995-08-30 15:17:13'),
            new Request(
                null,
                new RequestUrl('ogos/us-flag.gif'),
                null,
            ),
            new ResponseCode(400),
            null
        );

        $this->assertEquals($assertLog, $log);
    }

    public function testShouldThrowLogCreatorExceptionWhenException()
    {
        $this->expectException(LogCreatorException::class);
        
        $lineString = '[30:15:17:13] "ogos/us-flag.gif" 400';

        $log = $this->logCreator->fromLine($lineString);
    }
}