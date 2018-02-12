<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PropertyControllerTest extends WebTestCase
{
    public function testGetproperties()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'properties');
    }

    public function testPostproperty()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'add-property');
    }

}
