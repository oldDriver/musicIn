<?php

namespace App\Tests\Unit\Form\Type;

use App\Entity\User;
use App\Form\Type\UserNameType;
use Faker\Factory;
use Symfony\Component\Form\Test\TypeTestCase;

class UserNameTypeTest extends TypeTestCase
{
    /**
     * @test
     *
     * @dataProvider submitValidDataCases
     */
    public function submitValidData(array $formData, User $expected): void
    {
        $user = new User();
        $form = $this->factory->create(UserNameType::class, $user);
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $form->getData());
    }

    public function submitValidDataCases(): \Generator
    {
        $faker = Factory::create();
        $firstName = $faker->firstName();
        $middleName = $faker->name();
        $lastName = $faker->lastName();
        $user = new User();
        $user->setFirstName($firstName);
        yield [
            'formData' => [
                'firstName' => $firstName,
            ],
            'expected' => $user,
        ];
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        yield [
            'formData' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
            ],
            'expected' => $user,
        ];
        $user = new User();
        $user->setFirstName($firstName);
        $user->setMiddleName($middleName);
        $user->setLastName($lastName);
        yield [
            'formData' => [
                'firstName' => $firstName,
                'middleName' => $middleName,
                'lastName' => $lastName,
            ],
            'expected' => $user,
        ];
        $user = new User();
        $user->setFirstName($firstName);
        $user->setMiddleName($middleName);
        $user->setLastName($lastName);
        yield [
            'formData' => [
                'firstName' => $firstName,
                'middleName' => $middleName,
                'lastName' => $lastName,
                'dummyField' => 'test',
            ],
            'expected' => $user,
        ];
    }
}
