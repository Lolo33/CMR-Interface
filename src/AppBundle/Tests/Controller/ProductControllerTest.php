<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testGetproducts()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'products');
    }

    public function testGetproduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'products/{id}');
    }

    public function testPostproduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'add-product');
    }

    public function testDeleteproduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'del-product/{id}');
    }

}
