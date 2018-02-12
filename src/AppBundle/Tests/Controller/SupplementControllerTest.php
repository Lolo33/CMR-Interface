<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SupplementControllerTest extends WebTestCase
{
    public function testGetsupplements()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/{id}/supplements');
    }

    public function testPostsupplement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/{id}/add-supplement');
    }

    public function testPostproductsupplement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/{id}/add-prod-supplement');
    }

}
