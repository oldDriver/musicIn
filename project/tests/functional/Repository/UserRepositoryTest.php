<?php

namespace App\Tests\Functional\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;

    private UserRepository $repository;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine.orm.default_entity_manager');
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    /**
     * @test
     */
    public function find(): void
    {
        $entity = $this->repository->find(1);
        $this->assertInstanceOf(User::class, $entity);
        $this->assertEquals('admin@musicin.test', $entity->getEmail());
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $entity->getRoles());
    }

    /**
     * @test
     */
    public function findBy(): void
    {
        $array = $this->repository->findBy(['email' => 'admin@musicin.test']);
        $this->assertIsArray($array);
        $this->assertCount(1, $array);
        $entity = array_shift($array);
        $this->assertInstanceOf(User::class, $entity);
    }

    /**
     * @test
     */
    public function findAll(): void
    {
        $array = $this->repository->findAll();
        $this->assertIsArray($array);
        $this->assertCount(100, $array);
    }

    /**
     * @test
     */
    public function findOneBy(): void
    {
        $entity = $this->repository->findOneBy(['email' => 'admin@musicin.test']);
        $this->assertInstanceOf(User::class, $entity);
        $this->assertEquals('admin@musicin.test', $entity->getEmail());
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
