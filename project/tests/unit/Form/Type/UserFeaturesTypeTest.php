<?php

namespace App\Tests\Unit\Form\Type;

use App\Entity\User;
use App\Form\Type\UserFeaturesType;
use Faker\Factory;
use Symfony\Component\Form\Test\TypeTestCase;

class UserFeaturesTypeTest extends TypeTestCase
{
    /**
     * @test
     *
     * @dataProvider submitValidDataCases
     */
    public function submitValidData(array $formData, User $expected): void
    {
        $user = new User();
        $form = $this->factory->create(UserFeaturesType::class, $user);
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $form->getData());
    }

    public function submitValidDataCases(): \Generator
    {
        $faker = Factory::create();
        $isSinger = $faker->boolean();
        $isSongwriter = $faker->boolean();
        $isArranger = $faker->boolean();
        $isComposer = $faker->boolean();
        $isConductor = $faker->boolean();
        $user = new User();
        $user->setArranger($isArranger);
        $user->setComposer($isComposer);
        $user->setSongwriter($isSongwriter);
        $user->setSinger($isSinger);
        $user->setConductor($isConductor);
        yield [
            'formData' => [
                'singer' => $isSinger,
                'arranger' => $isArranger,
                'composer' => $isComposer,
                'songwriter' => $isSongwriter,
                'conductor' => $isConductor,
            ],
            'expected' => $user,
        ];
    }
}
