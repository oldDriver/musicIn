<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Instrument;
use App\Entity\Instrument as Entity;
use App\Entity\InstrumentType;
use App\Entity\User;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class InstrumentTest extends TestCase
{
    // Prepare to test
    private static ?Generator $faker = null;

    private ?Instrument $entity;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
    }

    public function setUp(): void
    {
        $this->entity = new Instrument();
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
        $name = self::$faker->word();
        $this->assertInstanceOf(Entity::class, $this->entity->setName($name));
        $this->assertEquals($name, $this->entity->getName());
        $this->assertEquals($name, $this->entity);
    }

    public function testType(): void
    {
        $type = $this->createMock(InstrumentType::class);
        $this->assertInstanceOf(Entity::class, $this->entity->setType($type));
        $this->assertEquals($type, $this->entity->getType());
    }

    public function testMusicians(): void
    {
        $musician = $this->createMock(User::class);
        $musician->expects($this->once())
            ->method('getInstrument')
            ->willReturn($this->entity);
        $this->assertEmpty($this->entity->getMusicians());
        $this->assertInstanceOf(Entity::class, $this->entity->addMusician($musician));
        $this->assertCount(1, $this->entity->getMusicians());
        $this->assertEquals($musician, $this->entity->getMusicians()->first());
        $this->assertInstanceOf(Entity::class, $this->entity->removeMusician($musician));
        $this->assertEmpty($this->entity->getMusicians());
    }

    public function testPerformers(): void
    {
        $performer = $this->createMock(User::class);
        $this->assertEmpty($this->entity->getPerformers());
        $this->assertInstanceOf(Entity::class, $this->entity->addPerformer($performer));
        $this->assertCount(1, $this->entity->getPerformers());
        $this->assertEquals($performer, $this->entity->getPerformers()->first());
        $this->assertInstanceOf(Entity::class, $this->entity->removePerformer($performer));
        $this->assertEmpty($this->entity->getPerformers());
    }

    public function testCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $this->assertInstanceOf(Entity::class, $this->entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $this->entity->getCreatedAt());
    }

    public function testUpdatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $this->assertNull($this->entity->getUpdatedAt());
        $this->assertInstanceOf(Entity::class, $this->entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $this->entity->getUpdatedAt());
    }

    public function testSetCreatedAtValue(): void
    {
        $this->entity->setCreatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $this->entity->getCreatedAt());
    }

    public function testSetUpdatedAtValue(): void
    {
        $this->assertNull($this->entity->getUpdatedAt());
        $this->entity->setUpdatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $this->entity->getUpdatedAt());
    }
}
