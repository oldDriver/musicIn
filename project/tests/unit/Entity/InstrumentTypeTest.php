<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Instrument;
use App\Entity\InstrumentType as Entity;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class InstrumentTypeTest extends TestCase
{
    /**
     * @test
     */
    public function name(): void
    {
        $faker = Factory::create();
        $name = $faker->word();
        $entity = new Entity();
        $this->assertInstanceOf(Entity::class, $entity->setName($name));
        $this->assertEquals($name, $entity->getName());
    }

    /**
     * @test
     */
    public function string(): void
    {
        $faker = Factory::create();
        $name = $faker->word();
        $entity = new Entity();
        $this->assertInstanceOf(Entity::class, $entity->setName($name));
        $this->assertEquals($name, $entity);
    }

    /**
     * @test
     */
    public function createdAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $entity = new Entity();
        $this->assertInstanceOf(Entity::class, $entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $entity->getCreatedAt());
    }

    /**
     * @test
     */
    public function updatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $entity = new Entity();
        $this->assertNull($entity->getUpdatedAt());
        $this->assertInstanceOf(Entity::class, $entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $entity->getUpdatedAt());
    }

    /**
     * @test
     */
    public function setCreatedAt(): void
    {
        $entity = new Entity();
        $entity->setCreatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $entity->getCreatedAt());
    }

    /**
     * @test
     */
    public function setUpdatedAtValue(): void
    {
        $entity = new Entity();
        $this->assertNull($entity->getUpdatedAt());
        $entity->setUpdatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $entity->getUpdatedAt());
    }

    /**
     * @test
     */
    public function instruments(): void
    {
        $instrument = new Instrument();
        $entity = new Entity();
        $this->assertEmpty($entity->getInstruments());
        $this->assertInstanceOf(Entity::class, $entity->addInstrument($instrument));
        $this->assertCount(1, $entity->getInstruments());
        $this->assertEquals($instrument, $entity->getInstruments()->first());
        $this->assertInstanceOf(Entity::class, $entity->removeInstrument($instrument));
        $this->assertEmpty($entity->getInstruments());
    }
}
