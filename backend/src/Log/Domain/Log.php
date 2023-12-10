<?php

namespace ufirst\Log\Domain;


class Log
{
    public function __construct(
        private Host $host,
        private LogDateTime $datetime,
        private Request $request,
        private ResponseCode $responseCode,
        private ?DocumentSize $documentSize
    )
    {
    }

    public function getHost(): Host
    {
        return $this->host;
    }

    public function getDatetime(): LogDateTime
    {
        return $this->datetime;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getResponseCode(): ResponseCode
    {
        return $this->responseCode;
    }

    public function getDocumentSize(): ?DocumentSize
    {
        return $this->documentSize;
    }
}