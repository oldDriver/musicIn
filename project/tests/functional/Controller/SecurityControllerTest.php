<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class SecurityControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function security(): void
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, '/login');
        $this->assertResponseIsSuccessful();
        $buttonLogin = $crawler->selectButton('Login');
        $form = $buttonLogin->form();
        $client->submit($form, [
            '_username' => 'user@musicin.test',
            '_password' => 'password',
        ]);
        $this->assertResponseRedirects('/profile');
        $client->request(Request::METHOD_GET, '/logout');
        $this->assertResponseRedirects();
    }
}
