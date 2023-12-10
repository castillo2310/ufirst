<?php

namespace ufirst\Log\Domain;

enum RequestMethod: string
{
    case GET = 'GET';
    case HEAD = 'HEAD';
    case POST = 'POST';
}