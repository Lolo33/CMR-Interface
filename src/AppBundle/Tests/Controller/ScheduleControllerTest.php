<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ScheduleControllerTest extends WebTestCase
{
    public function testGetschedules()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'schedules');
    }

    public function testPostschedule()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'add-schedule');
    }

    public function testUpdateschedule()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'upd-schedule/{id}');
    }

}
