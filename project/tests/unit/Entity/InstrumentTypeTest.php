<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Instrument;
use App\Entity\InstrumentType;
use App\Entity\InstrumentType as Entity;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class InstrumentTypeTest extends TestCase
{
    // Prepare to test
    private static ?Generator $faker = null;

    private ?InstrumentType $entity;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
    }

    public function setUp(): void
    {
        $this->entity = new InstrumentType();
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
    }

    public function testToString(): void
    {
        $name = self::$faker->word();
        $this->entity = new Entity();
        $this->assertInstanceOf(Entity::class, $this->entity->setName($name));
        $this->assertEquals($name, $this->entity);
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

    public function testSetCreatedAt(): void
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

    public function testInstruments(): void
    {
        $instrument = $this->createMock(Instrument::class);
        $this->assertEmpty($this->entity->getInstruments());
        $this->assertInstanceOf(Entity::class, $this->entity->addInstrument($instrument));
        $this->assertCount(1, $this->entity->getInstruments());
        $this->assertEquals($instrument, $this->entity->getInstruments()->first());
        $this->assertInstanceOf(Entity::class, $this->entity->removeInstrument($instrument));
        $this->assertEmpty($this->entity->getInstruments());
    }
}
