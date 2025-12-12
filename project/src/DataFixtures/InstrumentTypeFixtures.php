<?php

namespace App\DataFixtures;

use App\Entity\InstrumentType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InstrumentTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public const GUITARS = 'Guitars';
    public const BASS = 'Bass';
    public const DRUMS = 'Drums';
    public const BRASS = 'Brass';
    public const WOODWINDS = 'Woodwinds';
    public const STRINGS = 'Strings';
    public const PERCUSSION = 'Percussion';
    public const PIANO = 'Piano';
    public const ORGAN = 'Organ';
    /**
     * @var array<int, string>
     */
    private static $types = [
        self::GUITARS,
        self::BASS,
        self::BRASS,
        self::DRUMS,
        self::STRINGS,
        self::WOODWINDS,
        self::PERCUSSION,
        self::PIANO,
        self::ORGAN,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$types as $name) {
            $type = new InstrumentType();
            $type->setName($name);
            $manager->persist($type);
            $this->addReference('instrument_type_'.$name, $type);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CountryFixtures::class,
        ];
    }
}
