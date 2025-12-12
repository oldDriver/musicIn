<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public const CLASSICAL = 'Classical';
    public const AVANT_GARDE_EXPERIMENTAL = 'Avant-garde & Experimental';
    public const BLUES = 'Blues';
    public const COUNTRY = 'Country';
    public const EASY_LISTENING = 'Easy Listening';
    public const ELECTRONIC = 'Electronic';
    public const FOLK = 'Folk';
    public const HIP_HOP = 'Hip Hop';
    public const JAZZ = 'Jazz';
    public const POP = 'Pop';
    public const R_B_SOUL = 'R&B & Soul';
    public const ROCK = 'Rock';
    public const METAL = 'Metal';
    public const PUNK = 'Punk';
    public const AFRICAN = 'African';
    public const ANTARCTICA = 'Antarctica';
    public const ASIAN = 'Asian';
    public const AUSTRALASIA_OCEANIA = 'Australasia & Oceania';
    public const EUROPEAN = 'European';
    public const LATIN_SOUTH_AMERICAN = 'Latin & South American';
    public const NORTH_AMERICAN = 'North American';

    /**
     * @var array<int, string>
     */
    private static $genres = [
        self::CLASSICAL,
        self::AVANT_GARDE_EXPERIMENTAL,
        self::BLUES,
        self::COUNTRY,
        self::EASY_LISTENING,
        self::ELECTRONIC,
        self::FOLK,
        self::HIP_HOP,
        self::JAZZ,
        self::POP,
        self::R_B_SOUL,
        self::ROCK,
        self::METAL,
        self::PUNK,
        self::AFRICAN,
        self::ANTARCTICA,
        self::ASIAN,
        self::AUSTRALASIA_OCEANIA,
        self::EUROPEAN,
        self::LATIN_SOUTH_AMERICAN,
        self::NORTH_AMERICAN,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$genres as $name) {
            $genre = new Genre($name);
            $manager->persist($genre);
            $this->addReference('genre_'.$name, $genre);
        }
        $manager->flush();
    }
}
