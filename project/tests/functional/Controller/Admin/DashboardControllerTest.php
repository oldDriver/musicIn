<?php

namespace App\Tests\Unit\Controller\Admin;

use App\DataFixtures\UserFixtures;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class DashboardControllerTest extends WebTestCase
{
    private User $admin;
    private KernelBrowser $client;
    private AdminUrlGenerator $adminUrlGenerator;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $this->adminUrlGenerator = static::getContainer()->get(AdminUrlGenerator::class);
        $this->admin = $userRepository->findOneBy(['email' => UserFixtures::ADMIN_EMAIL]);
    }

    /**
     * @test
     */
    public function dashboard(): void
    {
        $this->client->loginUser($this->admin);
        $this->client->request(Request::METHOD_GET, $this->adminUrlGenerator->generateUrl('admin_dashboard'));
        $this->assertResponseIsSuccessful();
    }
}
