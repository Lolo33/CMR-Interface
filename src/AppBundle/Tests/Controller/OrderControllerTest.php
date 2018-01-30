<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
    public function testListcurrentorders()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'current-orders');
    }

    public function testListallorders()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'all-orders');
    }

    public function testShoworder()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'orders/{id}');
    }

    public function testPostorder()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'add-order');
    }

}
