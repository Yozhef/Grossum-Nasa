<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NeoControllerTest extends WebTestCase
{
    public function testHazardousTrueIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/hazardous');
        $testData = '[{"reference":1,"date":"2017-04-05T00:00:00+00:00","name":"Neo 1","speed":65605.672292416,"is_hazardous":true},{"reference":2,"date":"2017-04-07T00:00:00+00:00","name":"Neo 2","speed":34593.094094041,"is_hazardous":true}]';
        $content = $client->getResponse()->getContent();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($content, $testData);
    }

    public function testHazardousFailURLIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/hazardouss');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testFastestDefaultParamsDataIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/fastest');
        $content = $client->getResponse()->getContent();
        $testData = '[{"reference":3,"date":"2017-04-11T00:00:00+00:00","name":"Neo 3","speed":112463.65754211,"is_hazardous":false}]';

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($content, $testData);
    }

    public function testFastestParamsFalseDataIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/fastest?hazardous=false');
        $content = $client->getResponse()->getContent();
        $testData = '[{"reference":3,"date":"2017-04-11T00:00:00+00:00","name":"Neo 3","speed":112463.65754211,"is_hazardous":false}]';

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($content, $testData);
    }


    public function testFastestParamsTrueDataIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/fastest?hazardous=true');
        $content = $client->getResponse()->getContent();
        $testData = '[{"reference":1,"date":"2017-04-05T00:00:00+00:00","name":"Neo 1","speed":65605.672292416,"is_hazardous":true}]';

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains($content, $testData);
    }
}
