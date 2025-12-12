<?php

namespace App\Tests\Functional\Controller\User;

use App\DataFixtures\UserFixtures;
use App\Entity\User;
use App\Repository\InstrumentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class ProfileControllerTest extends WebTestCase
{
    private User $user;
    private KernelBrowser $client;
    private InstrumentRepository $instrumentRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $this->user = $userRepository->findOneBy(['email' => UserFixtures::USER_EMAIL]);
        $this->instrumentRepository = static::getContainer()->get(InstrumentRepository::class);
    }

    /**
     * @test
     */
    public function security(): void
    {
        $this->client->request(Request::METHOD_GET, '/profile');
        $this->assertResponseRedirects('/login');
        $this->client->request(Request::METHOD_GET, '/profile/edit/name');
        $this->assertResponseRedirects('/login');
        $this->client->request(Request::METHOD_GET, '/profile/edit/features');
        $this->assertResponseRedirects('/login');
        $this->client->request(Request::METHOD_GET, '/profile/edit/instruments');
        $this->assertResponseRedirects('/login');
    }

    /**
     * @test
     */
    public function index(): void
    {
        $this->client->loginUser($this->user);
        $this->client->request(Request::METHOD_GET, '/profile');
        $this->assertResponseIsSuccessful();
    }

    /**
     * @test
     */
    public function editName(): void
    {
        $this->client->loginUser($this->user);
        $crawler = $this->client->request(Request::METHOD_GET, '/profile/edit/name');
        $this->assertResponseIsSuccessful();
        $buttonSave = $crawler->selectButton('Save');
        $form = $buttonSave->form();
        $this->client->submit($form, [
            'user_name[firstName]' => 'User',
            'user_name[middleName]' => 'Jn.',
            'user_name[lastName]' => 'Tester',
        ]);
        $this->assertResponseRedirects('/profile');
    }

    /**
     * @test
     */
    public function editFeatures(): void
    {
        $this->client->loginUser($this->user);
        $crawler = $this->client->request(Request::METHOD_GET, '/profile/edit/features');
        $this->assertResponseIsSuccessful();
        $buttonSave = $crawler->selectButton('Save');
        $form = $buttonSave->form();
        $this->client->submit($form, [
            'user_features[singer]' => 1,
            'user_features[songwriter]' => 1,
            'user_features[composer]' => 1,
            'user_features[arranger]' => 1,
            'user_features[conductor]' => 1,
        ]);
        $this->assertResponseRedirects('/profile');
    }

    /**
     * @test
     */
    public function editInstruments(): void
    {
        $this->client->loginUser($this->user);
        $crawler = $this->client->request(Request::METHOD_GET, '/profile/edit/instruments');
        $this->assertResponseIsSuccessful();
        $buttonSave = $crawler->selectButton('Save');
        $form = $buttonSave->form();
        $this->client->submit($form, [
            'user_instruments[instrument]' => 1,
            'user_instruments[instruments]' => [3, 19],
        ]);
        $this->assertResponseRedirects('/profile');
    }

    /**
     * @test
     */
    public function editGenres(): void
    {
        $this->client->loginUser($this->user);
        $crawler = $this->client->request(Request::METHOD_GET, '/profile/edit/genres');
        $this->assertResponseIsSuccessful();
        $buttonSave = $crawler->selectButton('Save');
        $form = $buttonSave->form();
        $this->client->submit($form, [
            'user_genres[genres]' => [15, 16, 17],
        ]);
        $this->assertResponseRedirects('/profile');
    }
}
