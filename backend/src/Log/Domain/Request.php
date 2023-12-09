<?php

namespace ufirst\Log\Domain;

class Request
{
    public function __construct(
        private RequestMethod $method,
        private RequestUrl $url,
        private RequestProtocol $protocol,
    )
    {
    }

    public static function fromLogString(string $logString): Request
    {
        $string = trim($logString, '"');
        $data = explode(' ', $string);

        $method = RequestMethod::from($data[0]);
        $url = new RequestUrl($data[1]);
        $protocol = new RequestProtocol($data[2]);

        return new self(
            $method,
            $url,
            $protocol
        );
    }
}