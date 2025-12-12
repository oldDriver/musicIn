<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public const USA = 'United States';
    public const GRB = 'United Kingdom';
    public const ITA = 'Italia';
    public const VEN = 'Venezuela';
    public const AUT = 'Austria';
    public const ARG = 'Argentina';
    public const BEL = 'Belgium';
    public const FRA = 'France';
    public const DEU = 'Germany';
    public const JAM = 'Jamaica';
    public const ESP = 'Spain';
    public const DNK = 'Denmark';
    public const NDL = 'Netherlands';
    public const HUN = 'Hungary';
    public const SWE = 'Sweden';
    public const UKR = 'Ukraine';
    public const ISR = 'Israel';
    public const CHL = 'Chile';
    public const POL = 'Poland';
    public const CAN = 'Canada';
    public const CHE = 'Switzerland';
    public const ROU = 'Romania';

    /**
     * @var array<int, string>
     */
    private static $types = [
        self::USA,
        self::GRB,
        self::ITA,
        self::VEN,
        self::AUT,
        self::ARG,
        self::BEL,
        self::FRA,
        self::DEU,
        self::JAM,
        self::ESP,
        self::DNK,
        self::NDL,
        self::HUN,
        self::SWE,
        self::UKR,
        self::ISR,
        self::CHL,
        self::POL,
        self::CAN,
        self::CHE,
        self::ROU,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$types as $name) {
            $country = new Country();
            $country->setName($name);
            $manager->persist($country);
            $this->addReference('country_'.$name, $country);
        }
        $manager->flush();
    }
}
