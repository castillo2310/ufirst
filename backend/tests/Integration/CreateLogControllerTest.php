<?php

namespace Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateLogControllerTest extends WebTestCase
{
    const ROUTE = '/log';
    const METHOD = 'PUT';
    const FILE_CONTENT = '141.243.1.172 [29:23:53:25] "GET /Software.html HTTP/1.0" 200 1497
query2.lycos.cs.cmu.edu [29:23:53:36] "GET /Consumer.html HTTP/1.0" 200 1325
tanuki.twics.com [29:23:53:53] "GET /News.html HTTP/1.0" 200 1014
wpbfl2-45.gate.net [29:23:54:15] "GET / HTTP/1.0" 200 4889
wpbfl2-45.gate.net [29:23:54:16] "GET /icons/circle_logo_small.gif HTTP/1.0" 200 2624
wpbfl2-45.gate.net [29:23:54:18] "GET /logos/small_gopher.gif HTTP/1.0" 200 935
140.112.68.165 [29:23:54:19] "GET /logos/us-flag.gif HTTP/1.0" 200 2788';

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