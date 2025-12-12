<?php

namespace Tests\Functiona\Entity;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    private ?EntityManager $entityManager;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine.orm.default_entity_manager');
    }

    /**
     * @test
     */
    public function id(): void
    {
        $faker = Factory::create();
        $firstName = $faker->firstName();
        $lastName = $faker->lastName();
        $email = $faker->email();
        $password = $faker->password();
        $user = new User();
        $user->setFirstName($firstName);
        $user->setEmail($email);
        $user->setPassword($password);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->assertIsInt($user->getId());
        $this->assertInstanceOf(\DateTimeInterface::class, $user->getCreatedAt());
        $this->assertNull($user->getUpdatedAt());
        $user->setLastName($lastName);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->assertInstanceOf(\DateTimeInterface::class, $user->getUpdatedAt());
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        $this->assertNull($user->getId());
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
