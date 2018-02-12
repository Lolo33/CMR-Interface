<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductCategoryControllerTest extends WebTestCase
{
    public function testPostcategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'add-category');
    }

    public function testUpdatecategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'upd-category');
    }

    public function testDeletecategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'del-category');
    }

}
