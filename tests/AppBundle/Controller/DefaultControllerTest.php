<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testTrueIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $content = $client->getResponse()->getContent();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($content, '{"hello":"world!"}');
    }

    public function testFailIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/n');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

}
