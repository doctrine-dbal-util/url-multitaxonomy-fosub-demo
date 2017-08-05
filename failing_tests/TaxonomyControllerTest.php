<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaxonomyControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/taxonomy/');
        $response = $client->getResponse();

        // var_dump($response->getContent());

        // $this->assertTrue($response->isSuccessful());

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
        //  Internal Error 500
        // The server encountered an unexpected condition which prevented it from fulfilling the request. 

        // $this->assertContains('Home', $client->getResponse()->getContent());
        // $this->assertContains('XXXXxX344354353434', $response->getContent());
        
        // $this->getActualOutput();
    }
}
