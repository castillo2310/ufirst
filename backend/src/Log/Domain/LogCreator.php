<?php

namespace ufirst\Log\Domain;

use ufirst\Log\Domain\Exception\RequestDataNotFoundException;

class LogCreator
{
    public static function byLine(string $line): Log
    {
        $data = explode(' ', $line);

        $host = new Host($data[0]);
        $dateTime = LogDateTime::fromLogString($data[1]);

        if (!preg_match('/"([^"]*)"/', $line, $matches)) {
            throw new RequestDataNotFoundException();
        }

        $request = Request::fromLogString($matches[0]);

        $lineAfterRequest = trim(substr($line, strrpos($line, '"') + 1), ' ');
        $lineAfterRequestData = explode(' ', $lineAfterRequest);

        $responseCode = new ResponseCode(intval($lineAfterRequestData[0]));

        $rawDocumentSize = $lineAfterRequestData[1] ?? null;
        $documentSize = is_numeric($rawDocumentSize) ? new DocumentSize($rawDocumentSize) : null;

        return new Log(
            $host,
            $dateTime,
            $request,
            $responseCode,
            $documentSize
        );
    }
}