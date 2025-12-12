<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Singer;
use App\Entity\User;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class SingerTest extends TestCase
{
    // Prepare to test
    private static ?Generator $faker = null;

    private ?Singer $entity;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
    }

    public function setUp(): void
    {
        $this->entity = new Singer();
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
    public function testId(): void
    {
        $this->assertNull($this->entity->getId());
    }

    public function testUser(): void
    {
        $user = $this->createMock(User::class);
        $this->assertInstanceOf(Singer::class, $this->entity->setUser($user));
        $this->assertEquals($user, $this->entity->getUser());
    }

    public function testDescription(): void
    {
        $description = self::$faker->text();
        $this->assertNull($this->entity->getDescription());
        $this->assertInstanceOf(Singer::class, $this->entity->setDescription($description));
        $this->assertEquals($description, $this->entity->getDescription());
    }

    public function testCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $this->assertInstanceOf(Singer::class, $this->entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $this->entity->getCreatedAt());
    }

    public function testUpdatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $this->assertNull($this->entity->getUpdatedAt());
        $this->assertInstanceOf(Singer::class, $this->entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $this->entity->getUpdatedAt());
    }
}
