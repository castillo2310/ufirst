<?php

namespace ufirst\Log\Domain;

use ufirst\Shared\Domain\StringValueObject;

enum RequestProtocol: string
{
    case HTTP = 'HTTP';
}