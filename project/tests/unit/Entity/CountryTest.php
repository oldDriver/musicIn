<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Country;
use App\Entity\User;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    // Prepare to test
    private static ?Generator $faker = null;

    private ?Country $entity;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
    }

    public function setUp(): void
    {
        $this->entity = new Country();
    }

    public static function tearDownAfterClass(): void
    {
        self::$faker = null;
    }

    public function tearDown(): void
    {
        $this->entity = null;
    }

    // start tests
    public function testName(): void
    {
        $name = self::$faker->country();
        $this->assertInstanceOf(Country::class, $this->entity->setName($name));
        $this->assertEquals($name, $this->entity->getName());
    }

    public function testPersons(): void
    {
        $person = $this->createMock(User::class);
        $person->expects($this->once())
            ->method('getCountry')
            ->willReturn($this->entity);
        $this->assertEmpty($this->entity->getPersons());
        $this->assertInstanceOf(Country::class, $this->entity->addPerson($person));
        $this->assertEquals($person, $this->entity->getPersons()->first());
        $this->assertCount(1, $this->entity->getPersons());
        $this->assertInstanceOf(Country::class, $this->entity->removePerson($person));
        $this->assertEmpty($this->entity->getPersons());
    }

    public function testSetCreatedAtValue(): void
    {
        $this->entity->setCreatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $this->entity->getCreatedAt());
    }

    public function testSetUpdateAtValue(): void
    {
        $this->assertNull($this->entity->getUpdatedAt());
        $this->entity->setUpdatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $this->entity->getUpdatedAt());
    }

    public function testCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $this->assertInstanceOf(Country::class, $this->entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $this->entity->getCreatedAt());
    }

    public function testUpdatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $this->assertInstanceOf(Country::class, $this->entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $this->entity->getUpdatedAt());
    }
}
