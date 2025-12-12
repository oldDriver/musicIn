<?php

namespace App\DataFixtures;

use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InstrumentFixtures extends Fixture implements DependentFixtureInterface
{
    public const GUITAR = 'Guitar';
    public const PIANO = 'Piano';
    public const VIOLIN = 'Violin';
    public const CELLO = 'Cello';
    /**
     * @var array<string, array<int, string>>
     */
    private static iterable $instruments = [
        InstrumentTypeFixtures::GUITARS => [
            self::GUITAR,
            'Ukulele',
        ],
        InstrumentTypeFixtures::BASS => [
            'Bass',
            'Ukulele bass',
        ],
        InstrumentTypeFixtures::DRUMS => [
            'Drums',
            'Percussion',
        ],
        InstrumentTypeFixtures::PIANO => [
            self::PIANO,
        ],
        InstrumentTypeFixtures::ORGAN => [
            'Organ',
        ],
        InstrumentTypeFixtures::STRINGS => [
            self::VIOLIN,
            'Viola',
            self::CELLO,
            'Double Bass',
            'Harp',
        ],
        InstrumentTypeFixtures::WOODWINDS => [
            'Flute',
            'Oboe',
            'English Horn',
            'Clarinet',
            'E-flat Clarinet',
            'Bass Clarinet',
            'Bassoon',
            'Contrabassoon',
            'Saxophone',
        ],
        InstrumentTypeFixtures::BRASS => [
            'Trumpet',
            'French Horn',
            'Cornet',
            'Trombone',
            'Tuba',
            'Horn',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$instruments as $type => $list) {
            foreach ($list as $name) {
                $instrument = new Instrument();
                $instrument->setType($this->getReference('instrument_type_'.$type));
                $instrument->setName($name);
                $manager->persist($instrument);
                $this->addReference('instrument_'.$name, $instrument);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            InstrumentTypeFixtures::class,
        ];
    }
}
