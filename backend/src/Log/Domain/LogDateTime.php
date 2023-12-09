<?php

namespace ufirst\Log\Domain;

use ufirst\Log\Domain\Exception\LogDateTimeInvalidDayException;
use ufirst\Log\Domain\Exception\LogDateTimeInvalidFormatException;

class LogDateTime extends \DateTimeImmutable
{
    const YEAR = '1995';
    const MONTH = '08';
    const ALLOWED_DAYS = [29,30];
    const FORMAT = 'Y-m-d H:i:s';

    public static function fromLogString(string $logString): self
    {
        $string = str_replace(['[', ']'], '', $logString);
        $data = explode(':', $string);

        if (sizeof($data) !== 4) {
            throw new LogDateTimeInvalidFormatException();
        }

        $day = $data[0];
        if (!in_array(intval($day), self::ALLOWED_DAYS)) {
            throw new LogDateTimeInvalidDayException();
        }

        $time = implode(':', array_slice($data, 1));

        $datetimeString = self::YEAR . '-' . self::MONTH . '-' . $day . ' ' . $time;

        $datetime =  self::createFromFormat(self::FORMAT, $datetimeString);
        if (!$datetime) {
            throw new LogDateTimeInvalidFormatException();
        }

        return new self($datetime->format(self::FORMAT));
    }
}