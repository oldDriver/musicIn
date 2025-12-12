<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Genre;
use App\Entity\Genre as Entity;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class GenreTest extends TestCase
{
    // Prepare to test
    private static ?Generator $faker = null;

    private ?Genre $entity;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
    }

    public function setUp(): void
    {
        $name = self::$faker->word();
        $this->entity = new Genre($name);
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
    public function testConstructor(): void
    {
        $name = self::$faker->word();
        $this->assertInstanceOf(Genre::class, $this->entity->setName($name));
        $this->assertEquals($name, $this->entity->getName());
        $this->assertEquals($name, $this->entity);
    }

    public function testName(): void
    {
        $name = self::$faker->word();
        $this->assertInstanceOf(Entity::class, $this->entity->setName($name));
        $this->assertEquals($name, $this->entity->getName());
        $this->assertEquals($name, $this->entity);
    }

    public function testMusicians(): void
    {
        $musician = $this->createMock(User::class);
        $this->assertEmpty($this->entity->getMusicians());
        $this->assertInstanceOf(Entity::class, $this->entity->addMusician($musician));
        $this->assertInstanceOf(Collection::class, $this->entity->getMusicians());
        $this->assertCount(1, $this->entity->getMusicians());
        $this->assertEquals($musician, $this->entity->getMusicians()->first());
        $this->assertInstanceOf(Entity::class, $this->entity->removeMusician($musician));
        $this->assertEmpty($this->entity->getMusicians());
    }

    public function testCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $this->assertInstanceOf(Entity::class, $this->entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $this->entity->getCreatedAt());
    }

    public function testSetCreatedAtValue(): void
    {
        $this->entity->setCreatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $this->entity->getCreatedAt());
    }

    public function testUpdatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $this->assertNull($this->entity->getUpdatedAt());
        $this->assertInstanceOf(Entity::class, $this->entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $this->entity->getUpdatedAt());
    }

    public function testSetUpdatedAtValue(): void
    {
        $this->assertNull($this->entity->getUpdatedAt());
        $this->entity->setUpdatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $this->entity->getUpdatedAt());
    }
}
