<?php

namespace ufirst\tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use ufirst\Log\Domain\Exception\ResponseCodeInvalidException;
use ufirst\Log\Domain\ResponseCode;

class ResponseCodeTest extends TestCase
{
    public function testShouldReturnCorrectResponseCode(): void
    {
        $code = 200;
        $responseCode = new ResponseCode($code);
        
        $this->assertEquals($code, $responseCode->getValue());
    }

    public function testShouldThrowExceptionIfResponseCodeIsNotValid(): void
    {
        $this->expectException(ResponseCodeInvalidException::class);
        
        $code = 50;
        $responseCode = new ResponseCode($code);
    }
}