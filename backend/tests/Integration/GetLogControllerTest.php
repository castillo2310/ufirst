<?php

namespace ufirst\tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetLogControllerTest extends WebTestCase
{
    const ROUTE = '/log';
    const METHOD = 'GET';
    const FILE_CONTENT = '141.243.1.172 [29:23:53:25] "GET /Software.html HTTP/1.0" 200 1497';

    public function testShouldGetLogWithSuccess(): void
    {
        $client = $this->createClient();

        # Create log
        $client->request(
            self::METHOD,
            self::ROUTE,
            [
                'content' => base64_encode(self::FILE_CONTENT)
            ]
        );

        #Get log
        $client->request(self::METHOD, self::ROUTE);

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertEquals([
            [
                'host' => '141.243.1.172',
                'datetime' => [
                    'day' => '29',
                    'hour' => '23',
                    'minute' => '53',
                    'second' => '25',
                ],
                'request' => [
                    'method' => 'GET',
                    'url' => '/Software.html',
                    'protocol' => 'HTTP',
                    'protocol_version' => '1.0',
                ],
                'response_code' => 200,
                'document_size' => 1497,
            ]
        ], $response);
    }
}