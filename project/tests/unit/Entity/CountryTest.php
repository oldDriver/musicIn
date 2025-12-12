<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Country;
use App\Entity\User;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    /**
     * @test
     */
    public function name(): void
    {
        $faker = Factory::create();
        $name = $faker->country();
        $entity = new Country();
        $this->assertInstanceOf(Country::class, $entity->setName($name));
        $this->assertEquals($name, $entity->getName());
    }

    /**
     * @test
     */
    public function persons(): void
    {
        $person = new User();
        $entity = new Country();
        $this->assertEmpty($entity->getPersons());
        $this->assertInstanceOf(Country::class, $entity->addPerson($person));
        $this->assertEquals($person, $entity->getPersons()->first());
        $this->assertCount(1, $entity->getPersons());
        $this->assertInstanceOf(Country::class, $entity->removePerson($person));
        $this->assertEmpty($entity->getPersons());
    }

    /**
     * @test
     */
    public function setCreatedAtValue(): void
    {
        $entity = new Country();
        $entity->setCreatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $entity->getCreatedAt());
    }

    /**
     * @test
     */
    public function setUpdateAtValue(): void
    {
        $entity = new Country();
        $this->assertNull($entity->getUpdatedAt());
        $entity->setUpdatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $entity->getUpdatedAt());
    }

    /**
     * @test
     */
    public function createdAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $entity = new Country();
        $this->assertInstanceOf(Country::class, $entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $entity->getCreatedAt());
    }

    /**
     * @test
     */
    public function updatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $entity = new Country();
        $this->assertInstanceOf(Country::class, $entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $entity->getUpdatedAt());
    }
}
