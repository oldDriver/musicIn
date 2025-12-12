<?php

namespace Tests\Unit\Entity;

use App\Entity\Country;
use App\Entity\Instrument;
use App\Entity\User;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function email(): void
    {
        $faker = Factory::create();
        $email = $faker->email();
        $entity = new User();
        $this->assertInstanceOf(User::class, $entity->setEmail($email));
        $this->assertEquals($email, $entity->getEmail());
    }

    /**
     * @test
     */
    public function roles(): void
    {
        $faker = Factory::create();
        $role = $faker->word();
        $entity = new User();
        $this->assertEquals(['ROLE_USER'], $entity->getRoles());
        $entity->setRoles([$role]);
        $this->assertEquals([$role, 'ROLE_USER'], $entity->getRoles());
    }

    /**
     * @test
     */
    public function instrument(): void
    {
        $instrument = $this->createMock(Instrument::class);
        $entity = new User();
        $this->assertNull($entity->getInstrument());
        $this->assertInstanceOf(User::class, $entity->setInstrument($instrument));
        $this->assertEquals($instrument, $entity->getInstrument());
        $this->assertInstanceOf(User::class, $entity->setInstrument(null));
        $this->assertNull($entity->getInstrument());
    }

    /**
     * @test
     */
    public function country(): void
    {
        $country = new Country();
        $entity = new User();
        $this->assertNull($entity->getCountry());
        $this->assertInstanceOf(User::class, $entity->setCountry($country));
        $this->assertEquals($country, $entity->getCountry());
        $this->assertInstanceOf(User::class, $entity->setCountry(null));
        $this->assertNull($entity->getCountry());
    }

    /**
     * @test
     */
    public function password(): void
    {
        $faker = Factory::create();
        $password = $faker->password();
        $entity = new User();
        $this->assertNull($entity->getPassword());
        $this->assertInstanceOf(User::class, $entity->setPassword($password));
        $this->assertEquals($password, $entity->getPassword());
        $this->assertInstanceOf(User::class, $entity->resetPassword());
        $this->assertNull($entity->getPassword());
    }

    /**
     * @test
     */
    public function firstName(): void
    {
        $faker = Factory::create();
        $firstName = $faker->firstName();
        $entity = new User();
        $this->assertInstanceOf(User::class, $entity->setFirstName($firstName));
        $this->assertEquals($firstName, $entity->getFirstName());
    }

    /**
     * @test
     */
    public function middleName(): void
    {
        $faker = Factory::create();
        $middleName = $faker->name();
        $entity = new User();
        $this->assertNull($entity->getMiddleName());
        $this->assertInstanceOf(User::class, $entity->setMiddleName($middleName));
        $this->assertEquals($middleName, $entity->getMiddleName());
        $this->assertInstanceOf(User::class, $entity->setMiddleName(null));
        $this->assertNull($entity->getMiddleName());
    }

    /**
     * @test
     */
    public function lastName(): void
    {
        $faker = Factory::create();
        $lastName = $faker->lastName();
        $entity = new User();
        $this->assertNull($entity->getLastName());
        $this->assertInstanceOf(User::class, $entity->setLastName($lastName));
        $this->assertEquals($lastName, $entity->getLastName());
        $this->assertInstanceOf(User::class, $entity->setLastName(null));
        $this->assertNull($entity->getLastName());
    }

    /**
     * @test
     */
    public function isSinger(): void
    {
        $isSinger = true;
        $entity = new User();
        $this->assertFalse($entity->isSinger());
        $this->assertInstanceOf(User::class, $entity->setSinger($isSinger));
        $this->assertTrue($entity->isSinger());
    }

    /**
     * @test
     */
    public function isComposer(): void
    {
        $isComposer = true;
        $entity = new User();
        $this->assertFalse($entity->isComposer());
        $this->assertInstanceOf(User::class, $entity->setComposer($isComposer));
        $this->assertTrue($entity->isComposer());
    }

    /**
     * @test
     */
    public function isSongwriter(): void
    {
        $isSongwriter = true;
        $entity = new User();
        $this->assertFalse($entity->isSongwriter());
        $this->assertInstanceOf(User::class, $entity->setSongwriter($isSongwriter));
        $this->assertTrue($entity->isSongwriter());
    }

    /**
     * @test
     */
    public function isArranger(): void
    {
        $isArranger = true;
        $entity = new User();
        $this->assertFalse($entity->isArranger());
        $this->assertInstanceOf(User::class, $entity->setArranger($isArranger));
        $this->assertTrue($entity->isArranger());
    }

    /**
     * @test
     */
    public function isEducator(): void
    {
        $isEducator = true;
        $entity = new User();
        $this->assertFalse($entity->isEducator());
        $this->assertInstanceOf(User::class, $entity->setEducator($isEducator));
        $this->assertTrue($entity->isEducator());
    }

    /**
     * @test
     */
    public function validate(): void
    {
        $faker = Factory::create();
        $email = $faker->email();
        $firstName = $faker->firstName();
        $validator = Validation::createValidatorBuilder()->enableAttributeMapping()->getValidator();
        $entity = new User();
        $errors = $validator->validate($entity);
        $this->assertCount(2, $errors);
        $entity->setFirstName($firstName);
        $errors = $validator->validate($entity);
        $this->assertCount(1, $errors);
        $entity->setEmail('dummy');
        $errors = $validator->validate($entity);
        $this->assertCount(1, $errors);
        $entity->setEmail($email);
        $errors = $validator->validate($entity);
        $this->assertEmpty($errors);
    }

    /**
     * @test
     */
    public function setCreateAtValue(): void
    {
        $entity = new User();
        $entity->setCreatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $entity->getCreatedAt());
    }

    /**
     * @test
     */
    public function setUpdatedAtValue(): void
    {
        $entity = new User();
        $this->assertNull($entity->getUpdatedAt());
        $entity->setUpdatedAtValue();
        $this->assertInstanceOf(\DateTimeInterface::class, $entity->getUpdatedAt());
    }

    /**
     * @test
     */
    public function getUserIdentifier(): void
    {
        $faker = Factory::create();
        $email = $faker->email();
        $entity = new User();
        $this->assertInstanceOf(User::class, $entity->setEmail($email));
        $this->assertEquals($email, $entity->getUserIdentifier());
    }

    /**
     * @test
     */
    public function eraseCredentials(): void
    {
        $entity = new User();
        $entity->eraseCredentials();
        $this->assertInstanceOf(User::class, $entity);
    }

    /**
     * @test
     */
    public function createdAt(): void
    {
        $faker = Factory::create();
        $createdAt = new \DateTimeImmutable();
        $entity = new User();
        $this->assertInstanceOf(User::class, $entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $entity->getCreatedAt());
    }

    /**
     * @test
     */
    public function updatedAt(): void
    {
        $faker = Factory::create();
        $updatedAt = new \DateTimeImmutable();
        $entity = new User();
        $this->assertInstanceOf(User::class, $entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $entity->getUpdatedAt());
    }

    /**
     * @test
     */
    public function instruments(): void
    {
        $instrument = new Instrument();
        $entity = new User();
        $this->assertEmpty($entity->getInstruments());
        $this->assertInstanceOf(User::class, $entity->addInstrument($instrument));
        $this->assertCount(1, $entity->getInstruments());
        $this->assertEquals($instrument, $entity->getInstruments()->first());
        $this->assertInstanceOf(User::class, $entity->removeInstrument($instrument));
        $this->assertEmpty($entity->getInstruments());
    }

    /**
     * @test
     *
     * @dataProvider hasFeaturesCases
     */
    public function hasFeatures(bool $isSinger, bool $isSongwriter, bool $isComposer, bool $isArranger, bool $expected): void
    {
        $entity = new User();
        $entity->setSinger($isSinger);
        $entity->setSongwriter($isSongwriter);
        $entity->setComposer($isComposer);
        $entity->setArranger($isArranger);
        $this->assertEquals($expected, $entity->hasFeatures());
    }

    public function hasFeaturesCases(): \Generator
    {
        yield [
            'isSinger' => false,
            'isSongwriter' => false,
            'isComposer' => false,
            'isArranger' => false,
            'expected' => false,
        ];

        yield [
            'isSinger' => true,
            'isSongwriter' => false,
            'isComposer' => false,
            'isArranger' => false,
            'expected' => true,
        ];
    }
}
