<?php

namespace ufirst\Log\Domain;

class Request
{
    public function __construct(
        private ?RequestMethod $method,
        private RequestUrl $url,
        private ?RequestProtocol $protocol,
    )
    {
    }

    public static function fromLogString(string $logString): Request
    {
        $string = trim($logString, '"');
        $data = explode(' ', $string);

        $method = $protocol = null;
        if (sizeof($data) === 1) {
            $url = new RequestUrl($data[0]);
        } elseif (sizeof($data) === 2) {
            $method = RequestMethod::from($data[0]);
            $url = new RequestUrl($data[1]);
        } else {
            $method = RequestMethod::from($data[0]);
            $protocol = RequestProtocol::tryFrom($data[sizeof($data) - 1]);

            $length = is_null($protocol) ? null : sizeof($data) - 2;
            $rawUrl = implode(' ', array_slice($data, 1, $length));

            $url = new RequestUrl($rawUrl);
        }

        return new self(
            $method,
            $url,
            $protocol
        );
    }
}