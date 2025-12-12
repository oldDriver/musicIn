<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Instrument as Entity;
use App\Entity\InstrumentType;
use App\Entity\User;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class InstrumentTest extends TestCase
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
        $this->assertEquals($name, $entity);
    }

    /**
     * @test
     */
    public function type(): void
    {
        $type = new InstrumentType();
        $entity = new Entity();
        $this->assertInstanceOf(Entity::class, $entity->setType($type));
        $this->assertEquals($type, $entity->getType());
    }

    /**
     * @test
     */
    public function musicians(): void
    {
        $musician = new User();
        $entity = new Entity();
        $this->assertEmpty($entity->getMusicians());
        $this->assertInstanceOf(Entity::class, $entity->addMusician($musician));
        $this->assertCount(1, $entity->getMusicians());
        $this->assertEquals($musician, $entity->getMusicians()->first());
        $this->assertInstanceOf(Entity::class, $entity->removeMusician($musician));
        $this->assertEmpty($entity->getMusicians());
    }

    /**
     * @test
     */
    public function performers(): void
    {
        $performer = new User();
        $entity = new Entity();
        $this->assertEmpty($entity->getPerformers());
        $this->assertInstanceOf(Entity::class, $entity->addPerformer($performer));
        $this->assertCount(1, $entity->getPerformers());
        $this->assertEquals($performer, $entity->getPerformers()->first());
        $this->assertInstanceOf(Entity::class, $entity->removePerformer($performer));
        $this->assertEmpty($entity->getPerformers());
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
    public function setCreatedAtValue(): void
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
}
