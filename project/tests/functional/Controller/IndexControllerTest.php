<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class IndexControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function index(): void
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, '/');

        $this->assertResponseIsSuccessful();
    }
}
