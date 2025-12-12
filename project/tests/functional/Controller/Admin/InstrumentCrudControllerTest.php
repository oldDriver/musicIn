<?php

namespace App\Tests\Functional\Controller\Admin;

use App\Controller\Admin\InstrumentCrudController;
use App\DataFixtures\UserFixtures;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class InstrumentCrudControllerTest extends WebTestCase
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
    public function index(): void
    {
        $this->client->loginUser($this->admin);
        $this->client->request(
            Request::METHOD_GET,
            $this->adminUrlGenerator
                ->setController(InstrumentCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );
        $this->assertResponseIsSuccessful();
    }
}
