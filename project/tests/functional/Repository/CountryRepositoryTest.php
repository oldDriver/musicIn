<?php

namespace App\Tests\Functional\Repository;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CountryRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;

    private CountryRepository $repository;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine.orm.default_entity_manager');
        $this->repository = $this->entityManager->getRepository(Country::class);
    }

    public function testFind(): void
    {
        $entity = $this->repository->find(1);
        $this->assertInstanceOf(Country::class, $entity);
        $this->assertEquals('United States', $entity->getName());
    }

    public function testFindBy(): void
    {
        $array = $this->repository->findBy(['name' => 'United States']);
        $this->assertIsArray($array);
        $this->assertCount(1, $array);
        $entity = array_shift($array);
        $this->assertInstanceOf(Country::class, $entity);
    }

    public function testFindAll(): void
    {
        $array = $this->repository->findAll();
        $this->assertIsArray($array);
        $this->assertCount(22, $array);
    }

    /**
     * @test
     */
    public function findOneBy(): void
    {
        $entity = $this->repository->findOneBy(['name' => 'United States']);
        $this->assertInstanceOf(Country::class, $entity);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
