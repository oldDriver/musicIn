<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private const PASSWORD = 'password';
    public const ADMIN_EMAIL = 'admin@musicin.test';
    public const USER_EMAIL = 'user@musicin.test';
    /**
     * @var array<int, array<string, array<int, string>|bool|string|null>>
     */
    private static iterable $persons = [
        // Conductors
        [
            'firstName' => 'Leonard',
            'middleName' => null,
            'lastName' => 'Bernstein',
            'conductor' => true,
            'composer' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'instrument' => InstrumentFixtures::PIANO,
            'country' => CountryFixtures::USA,
        ],
        [
            'firstName' => 'Arturo',
            'lastName' => 'Toscanini',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::ITA,
        ],
        [
            'firstName' => 'Sir Simon',
            'lastName' => 'Rattle',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::GRB,
        ],
        [
            'firstName' => 'Gustavo',
            'lastName' => 'Dudamel',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::VEN,
        ],
        [
            'firstName' => 'Nikolaus',
            'lastName' => 'Harnoncourt',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::AUT,
        ],
        [
            'firstName' => 'Bernard',
            'lastName' => 'Haitink',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::NDL,
        ],
        [
            'firstName' => 'Aaron',
            'lastName' => 'Copland',
            'conductor' => true,
            'composer' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'instrument' => InstrumentFixtures::PIANO,
            'country' => CountryFixtures::USA,
        ],
        [
            'firstName' => 'Fritz',
            'lastName' => 'Busch',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::HUN,
        ],
        [
            'firstName' => 'Claudio',
            'lastName' => 'Abbado',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::ITA,
        ],
        [
            'firstName' => 'Carlos',
            'lastName' => 'Kleiber',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::AUT,
        ],
        [
            'firstName' => 'Daniel',
            'lastName' => 'Barenboim',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::ARG,
        ],
        [
            'firstName' => 'John',
            'lastName' => 'Barbirolli',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'instrument' => InstrumentFixtures::CELLO,
            'country' => CountryFixtures::GRB,
        ],
        [
            'firstName' => 'Pierre',
            'lastName' => 'Boulez',
            'composer' => true,
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::FRA,
        ],
        [
            'firstName' => 'Nadia',
            'lastName' => 'Boulanger',
            'composer' => true,
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::FRA,
        ],
        [
            'firstName' => 'Benjamin',
            'lastName' => 'Britten',
            'composer' => true,
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'instrument' => InstrumentFixtures::PIANO,
            'country' => CountryFixtures::GRB,
        ],
        [
            'firstName' => 'Herbert',
            'lastName' => 'Blomstedt',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::SWE,
        ],
        [
            'firstName' => 'Herbert',
            'lastName' => 'von Karajan',
            'conductor' => true,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::AUT,
        ],
        // voilinists
        [
            'firstName' => 'Antonio',
            'lastName' => 'Vivaldi',
            'instrument' => InstrumentFixtures::VIOLIN,
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::ITA,
        ],
        [
            'firstName' => 'Niccolo',
            'lastName' => 'Paganini',
            'composer' => true,
            'instrument' => InstrumentFixtures::VIOLIN,
            'instruments' => [InstrumentFixtures::GUITAR],
            'genres' => [GenreFixtures::CLASSICAL],
            'country' => CountryFixtures::ITA,
        ],
        [
            'firstName' => 'Pablo',
            'lastName' => 'de Sarasate',
            'composer' => true,
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::ESP,
        ],
        [
            'firstName' => 'Eugène',
            'lastName' => 'Ysaÿe',
            'composer' => true,
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::BEL,
        ],
        [
            'firstName' => 'Fritz',
            'lastName' => 'Kreisler',
            'composer' => true,
            'country' => CountryFixtures::AUT,
        ],
        [
            'firstName' => 'Jasha',
            'lastName' => 'Heifetz',
            'composer' => true,
            'country' => CountryFixtures::USA,
        ],
        [
            'firstName' => 'David',
            'lastName' => 'Oistrakh',
            'conductor' => true,
//            'educator' => true,
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::UKR,
        ],
        [
            'firstName' => 'Yehudi',
            'lastName' => 'Menuhin',
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::USA,
        ],
        [
            'firstName' => 'Itzhak',
            'lastName' => 'Perlman',
            'conductor' => true,
//            'educator' => true,
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::ISR,
        ],
        [
            'firstName' => 'Hilary',
            'lastName' => 'Hahn',
            'instrument' => InstrumentFixtures::VIOLIN,
            'country' => CountryFixtures::USA,
        ],
        [
            'firstName' => 'Eric',
            'lastName' => 'Clapton',
            'singer' => true,
            'country' => CountryFixtures::GRB,
            'instrument' => InstrumentFixtures::GUITAR,
            'genres' => [
                GenreFixtures::ROCK,
                GenreFixtures::BLUES,
                GenreFixtures::JAZZ,
            ],
        ],
        // pianists
        [
            'firstName' => 'Claudio',
            'lastName' => 'Arrau',
            'instrument' => InstrumentFixtures::PIANO,
            'country' => CountryFixtures::CHL,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],
        [
            'firstName' => 'Josef',
            'lastName' => 'Hofmann',
            'instrument' => InstrumentFixtures::PIANO,
            'country' => CountryFixtures::POL,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],
        [
            'firstName' => 'Walter',
            'lastName' => 'Gleseking',
            'country' => CountryFixtures::DEU,
            'instrument' => InstrumentFixtures::PIANO,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],
        [
            'firstName' => 'Glenn',
            'lastName' => 'Gould',
            'country' => CountryFixtures::CAN,
            'instrument' => InstrumentFixtures::PIANO,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],
        [
            'firstName' => 'Murray',
            'lastName' => 'Perahla',
            'country' => CountryFixtures::USA,
            'instrument' => InstrumentFixtures::PIANO,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],
        [
            'firstName' => 'Wilhelm',
            'lastName' => 'Kempff',
            'country' => CountryFixtures::DEU,
            'instrument' => InstrumentFixtures::PIANO,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],
        [
            'firstName' => 'Edwin',
            'lastName' => 'Fisher',
            'country' => CountryFixtures::CHE,
            'instrument' => InstrumentFixtures::PIANO,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],
        [
            'firstName' => 'Radu',
            'lastName' => 'Lupu',
            'country' => CountryFixtures::ROU,
            'instrument' => InstrumentFixtures::PIANO,
            'genres' => [
                GenreFixtures::CLASSICAL,
            ],
        ],

    ];

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $admin = new User();
        $admin->setEmail(self::ADMIN_EMAIL);
        $password = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($password);
        $admin->setFirstName('Admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $this->addReference('admin', $admin);

        $user = new User();
        $user->setEmail(self::USER_EMAIL);
        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);
        $user->setFirstName('User');
        $user->setCountry($this->getReference('country_'.CountryFixtures::USA));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $this->addReference('user', $user);

        foreach (self::$persons as $person) {
            $user = new User();
            $user->setEmail($this->retrieveEmail($person));
            $password = $this->hasher->hashPassword($user, self::PASSWORD);
            $user->setPassword($password);
            $user->setFirstName($person['firstName']);
            if (isset($person['middleName']) && !empty($person['middleName'])) {
                $user->setMiddleName($person['middleName']);
            }
            if (isset($person['lastName']) && !empty($person['lastName'])) {
                $user->setLastName($person['lastName']);
            }
            if (isset($person['singer']) && $person['singer']) {
                $user->setSinger(true);
            }
            if (isset($person['composer']) && $person['composer']) {
                $user->setComposer(true);
            }
            if (isset($person['songwriter']) && $person['songwriter']) {
                $user->setSongwriter(true);
            }
            if (isset($person['arranger']) && $person['arranger']) {
                $user->setArranger(true);
            }
            if (isset($person['conductor']) && $person['conductor']) {
                $user->setConductor(true);
            }
            if (isset($person['instrument']) && $person['instrument']) {
                $user->setInstrument($this->getReference('instrument_'.$person['instrument']));
            }
            if (isset($person['instruments']) && !empty($person['instruments'])) {
                foreach ($person['instruments'] as $instrument) {
                    $user->addInstrument($this->getReference('instrument_'.$instrument));
                }
            }
            if (isset($person['genres']) && !empty($person['genres'])) {
                foreach ($person['genres'] as $genre) {
                    $user->addGenre($this->getReference('genre_'.$genre));
                }
            }
            if (isset($person['country']) && $person['country']) {
                $user->setCountry($this->getReference('country_'.$person['country']));
            }

            $manager->persist($user);
        }
        $manager->flush();

        for ($i = 2; $i < 64; ++$i) {
            $user = new User();
            $user->setEmail($faker->email());
            $password = $this->hasher->hashPassword($user, $faker->password());
            $user->setPassword($password);
            $user->setFirstName($faker->firstName());
            $manager->persist($user);
        }
        $manager->flush();
    }

    /**
     * @param array<string, string> $person
     */
    private function retrieveEmail(array $person): string
    {
        $email = [];
        if (isset($person['firstName']) && !empty($person['firstName'])) {
            $email[] = strtolower($person['firstName']);
        }
        if (isset($person['middleName']) && !empty($person['middleName'])) {
            $email[] = strtolower($person['middleName']);
        }
        if (isset($person['lastName']) && !empty($person['lastName'])) {
            $email[] = strtolower($person['lastName']);
        }

        return implode('.', $email).'@musicin.test';
    }

    public function getDependencies()
    {
        return [
            GenreFixtures::class,
            InstrumentFixtures::class,
            CountryFixtures::class,
        ];
    }
}
