<?php

namespace ufirst\Log\Domain;

class Request
{
    public function __construct(
        private ?RequestMethod $method,
        private RequestUrl $url,
        private ?RequestProtocol $protocol,
        private ?RequestProtocolVersion $protocolVersion,
    )
    {
    }

    public static function fromLogString(string $logString): Request
    {
        $string = trim($logString, '"');
        $data = explode(' ', $string);

        $method = $protocol = $protocolVersion = null;
        if (sizeof($data) === 1) {
            $url = new RequestUrl($data[0]);
        } elseif (sizeof($data) === 2) {
            $method = RequestMethod::from($data[0]);
            $url = new RequestUrl($data[1]);
        } else {
            $method = RequestMethod::from($data[0]);

            $rawProtocol = $data[sizeof($data) - 1];
            if (!empty($rawProtocol)) {
                $protocolData = explode('/', $rawProtocol);
                if (sizeof($protocolData) === 2) {
                    $protocol = RequestProtocol::tryFrom($protocolData[0]);
                    $protocolVersion = RequestProtocolVersion::tryFrom($protocolData[1]);
                }
            }

            $length = is_null($protocol) ? null : sizeof($data) - 2;
            $rawUrl = implode(' ', array_slice($data, 1, $length));

            $url = new RequestUrl($rawUrl);
        }

        return new self(
            $method,
            $url,
            $protocol,
            $protocolVersion
        );
    }

    public function getMethod(): ?RequestMethod
    {
        return $this->method;
    }

    public function getUrl(): RequestUrl
    {
        return $this->url;
    }

    public function getProtocol(): ?RequestProtocol
    {
        return $this->protocol;
    }

    public function getProtocolVersion(): ?RequestProtocolVersion
    {
        return $this->protocolVersion;
    }
}