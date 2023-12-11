<?php

namespace ufirst\tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateLogControllerTest extends WebTestCase
{
    const ROUTE = '/log';
    const METHOD = 'PUT';
    const FILE_CONTENT = '141.243.1.172 [29:23:53:25] "GET /Software.html HTTP/1.0" 200 1497';

    public function testShouldCreateLogWithSuccess(): void
    {
        $client = $this->createClient();
        $client->request(
            self::METHOD,
            self::ROUTE,
            [
                'content' => base64_encode(self::FILE_CONTENT)
            ]
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}