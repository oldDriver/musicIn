<?php

namespace Tests\Unit\Entity;

use App\Entity\Country;
use App\Entity\Educator;
use App\Entity\Genre;
use App\Entity\Instrument;
use App\Entity\Manager;
use App\Entity\Possessor;
use App\Entity\Singer;
use App\Entity\User;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class UserTest extends TestCase
{
    // Prepare to test
    private static ?Generator $faker = null;

    private ?User $entity;

    public static function setUpBeforeClass(): void
    {
        self::$faker = Factory::create();
    }

    public function setUp(): void
    {
        $this->entity = new User();
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
    public function testEmail(): void
    {
        $email = self::$faker->email();
        $this->assertInstanceOf(User::class, $this->entity->setEmail($email));
        $this->assertEquals($email, $this->entity->getEmail());
    }

    public function testRoles(): void
    {
        $role = self::$faker->word();
        $this->assertEquals(['ROLE_USER'], $this->entity->getRoles());
        $this->assertInstanceOf(User::class, $this->entity->setRoles([$role]));
        $this->assertEquals([$role, 'ROLE_USER'], $this->entity->getRoles());
    }

    public function testInstrument(): void
    {
        $instrument = $this->createMock(Instrument::class);
        $this->assertNull($this->entity->getInstrument());
        $this->assertInstanceOf(User::class, $this->entity->setInstrument($instrument));
        $this->assertEquals($instrument, $this->entity->getInstrument());
        $this->assertInstanceOf(User::class, $this->entity->setInstrument(null));
        $this->assertNull($this->entity->getInstrument());
    }

    public function testCountry(): void
    {
        $country = $this->createMock(Country::class);
        $this->assertNull($this->entity->getCountry());
        $this->assertInstanceOf(User::class, $this->entity->setCountry($country));
        $this->assertEquals($country, $this->entity->getCountry());
        $this->assertInstanceOf(User::class, $this->entity->setCountry(null));
        $this->assertNull($this->entity->getCountry());
    }

    public function testPassword(): void
    {
        $password = self::$faker->password();
        $this->assertNull($this->entity->getPassword());
        $this->assertInstanceOf(User::class, $this->entity->setPassword($password));
        $this->assertEquals($password, $this->entity->getPassword());
        $this->assertInstanceOf(User::class, $this->entity->resetPassword());
        $this->assertNull($this->entity->getPassword());
    }

    public function testFirstName(): void
    {
        $firstName = self::$faker->firstName();
        $this->assertInstanceOf(User::class, $this->entity->setFirstName($firstName));
        $this->assertEquals($firstName, $this->entity->getFirstName());
    }

    public function testMiddleName(): void
    {
        $middleName = self::$faker->name();
        $this->assertNull($this->entity->getMiddleName());
        $this->assertInstanceOf(User::class, $this->entity->setMiddleName($middleName));
        $this->assertEquals($middleName, $this->entity->getMiddleName());
        $this->assertInstanceOf(User::class, $this->entity->setMiddleName(null));
        $this->assertNull($this->entity->getMiddleName());
    }

    public function testLastName(): void
    {
        $lastName = self::$faker->lastName();
        $this->assertNull($this->entity->getLastName());
        $this->assertInstanceOf(User::class, $this->entity->setLastName($lastName));
        $this->assertEquals($lastName, $this->entity->getLastName());
        $this->assertInstanceOf(User::class, $this->entity->setLastName(null));
        $this->assertNull($this->entity->getLastName());
    }

    public function testSinger(): void
    {
        $singer = true;
        $this->assertFalse($this->entity->isSinger());
        $this->assertInstanceOf(User::class, $this->entity->setSinger($singer));
        $this->assertTrue($this->entity->isSinger());
    }

    public function testComposer(): void
    {
        $composer = true;
        $this->assertFalse($this->entity->isComposer());
        $this->assertInstanceOf(User::class, $this->entity->setComposer($composer));
        $this->assertTrue($this->entity->isComposer());
    }

    public function testSongwriter(): void
    {
        $songwriter = true;
        $this->assertFalse($this->entity->isSongwriter());
        $this->assertInstanceOf(User::class, $this->entity->setSongwriter($songwriter));
        $this->assertTrue($this->entity->isSongwriter());
    }

    public function testArranger(): void
    {
        $arranger = true;
        $this->assertFalse($this->entity->isArranger());
        $this->assertInstanceOf(User::class, $this->entity->setArranger($arranger));
        $this->assertTrue($this->entity->isArranger());
    }

    public function testEducator(): void
    {
        $educator = true;
        $this->assertFalse($this->entity->isEducator());
        $this->assertInstanceOf(User::class, $this->entity->setEducator($educator));
        $this->assertTrue($this->entity->isEducator());
    }

    public function testValidate(): void
    {
        $email = self::$faker->email();
        $firstName = self::$faker->firstName();
        $validator = Validation::createValidatorBuilder()->enableAttributeMapping()->getValidator();
        $this->entity = new User();
        $errors = $validator->validate($this->entity);
        $this->assertCount(2, $errors);
        $this->entity->setFirstName($firstName);
        $errors = $validator->validate($this->entity);
        $this->assertCount(1, $errors);
        $this->entity->setEmail('dummy');
        $errors = $validator->validate($this->entity);
        $this->assertCount(1, $errors);
        $this->entity->setEmail($email);
        $errors = $validator->validate($this->entity);
        $this->assertEmpty($errors);
    }

    public function testSetCreateAtValue(): void
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

    public function testGetUserIdentifier(): void
    {
        $email = self::$faker->email();
        $this->entity = new User();
        $this->assertInstanceOf(User::class, $this->entity->setEmail($email));
        $this->assertEquals($email, $this->entity->getUserIdentifier());
    }

    public function testEraseCredentials(): void
    {
        $this->entity->eraseCredentials();
        $this->assertInstanceOf(User::class, $this->entity);
    }

    public function testCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $this->entity = new User();
        $this->assertInstanceOf(User::class, $this->entity->setCreatedAt($createdAt));
        $this->assertEquals($createdAt, $this->entity->getCreatedAt());
    }

    public function testUpdatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $this->entity = new User();
        $this->assertInstanceOf(User::class, $this->entity->setUpdatedAt($updatedAt));
        $this->assertEquals($updatedAt, $this->entity->getUpdatedAt());
    }

    public function testInstruments(): void
    {
        $instrument = $this->createMock(Instrument::class);
        $this->assertEmpty($this->entity->getInstruments());
        $this->assertInstanceOf(User::class, $this->entity->addInstrument($instrument));
        $this->assertCount(1, $this->entity->getInstruments());
        $this->assertEquals($instrument, $this->entity->getInstruments()->first());
        $this->assertInstanceOf(User::class, $this->entity->removeInstrument($instrument));
        $this->assertEmpty($this->entity->getInstruments());
    }

    /**
     * @dataProvider hasFeaturesCases
     */
    public function testHasFeatures(bool $singer, bool $songwriter, bool $composer, bool $arranger, bool $expected): void
    {
        $this->entity->setSinger($singer);
        $this->entity->setSongwriter($songwriter);
        $this->entity->setComposer($composer);
        $this->entity->setArranger($arranger);
        $this->assertEquals($expected, $this->entity->hasFeatures());
    }

    public function hasFeaturesCases(): \Generator
    {
        yield [
            'singer' => false,
            'songwriter' => false,
            'composer' => false,
            'arranger' => false,
            'expected' => false,
        ];

        yield [
            'singer' => true,
            'songwriter' => false,
            'composer' => false,
            'arranger' => false,
            'expected' => true,
        ];
    }

    public function testPossessor(): void
    {
        $this->assertFalse($this->entity->isPossessor());
        $this->assertInstanceOf(User::class, $this->entity->setPossessor(true));
        $this->assertTrue($this->entity->isPossessor());
    }

    public function testManager(): void
    {
        $this->assertFalse($this->entity->isManager());
        $this->assertInstanceOf(User::class, $this->entity->setManager(true));
        $this->assertTrue($this->entity->isManager());
    }

    public function testImpressario(): void
    {
        $this->assertFalse($this->entity->isImpresario());
        $this->assertInstanceOf(User::class, $this->entity->setImpresario(true));
        $this->assertTrue($this->entity->isImpresario());
    }

    public function testManagerDetails(): void
    {
        $details = $this->createMock(Manager::class);
        $this->assertNull($this->entity->getManagerDetails());
        $this->assertInstanceOf(User::class, $this->entity->setManagerDetails($details));
        $this->assertEquals($details, $this->entity->getManagerDetails());
    }

    public function testEducatorDetails(): void
    {
        $details = $this->createMock(Educator::class);
        $this->assertNull($this->entity->getEducatorDetails());
        $this->assertInstanceOf(User::class, $this->entity->setEducatorDetails($details));
        $this->assertEquals($details, $this->entity->getEducatorDetails());
    }

    public function testSingerDetails(): void
    {
        $details = $this->createMock(Singer::class);
        $this->assertNull($this->entity->getSingerDetails());
        $this->assertInstanceOf(User::class, $this->entity->setSingerDetails($details));
        $this->assertEquals($details, $this->entity->getSingerDetails());
    }

    public function testPossessorDetails(): void
    {
        $details = $this->createMock(Possessor::class);
        $this->assertNull($this->entity->getPossessorDetails());
        $this->assertInstanceOf(User::class, $this->entity->setPossessorDetails($details));
        $this->assertEquals($details, $this->entity->getPossessorDetails());
    }

    public function testGenre(): void
    {
        $genre = $this->createMock(Genre::class);
        $this->assertEmpty($this->entity->getGenres());
        $this->assertInstanceOf(User::class, $this->entity->addGenre($genre));
        $this->assertEquals($genre, $this->entity->getGenres()->last());
        $this->assertInstanceOf(User::class, $this->entity->removeGenre($genre));
        $this->assertEmpty($this->entity->getGenres());
    }
}
