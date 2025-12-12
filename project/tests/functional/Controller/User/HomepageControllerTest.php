<?php

namespace App\Tests\Functional\Controller\User;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class HomepageControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function homepageSecurity(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/homepage');
        $this->assertResponseRedirects('/login');
    }

    /**
     * @test
     */
    public function homepage(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy(['email' => 'user@musicin.test']);
        $client->loginUser($user);
        $client->request(Request::METHOD_GET, '/homepage');
        $this->assertResponseIsSuccessful();
    }
}
