<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );

        $this->assertContains('password', $client->getResponse()->getContent());
    }

    public function testLogout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/logout');

        $this->assertEquals(
            302,
            $client->getResponse()->getStatusCode()
        );

        $this->assertContains('refresh', $client->getResponse()->getContent());
    }

    public function testResetting()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/resetting/request');

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );

        $this->assertContains('username', $client->getResponse()->getContent());
    }
}
