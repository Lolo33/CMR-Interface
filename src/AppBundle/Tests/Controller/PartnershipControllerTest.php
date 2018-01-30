<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PartnershipControllerTest extends WebTestCase
{
    public function testGetpartnership()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'my-partners');
    }

    public function testPostpartnership()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'partners');
    }

    public function testGetpartner()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'partner/{id}');
    }

}
