<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'user.first_name',
            ])
            ->add('middleName', TextType::class, [
                'required' => false,
                'label' => 'user.middle_name',
            ])
            ->add('lastName', TextType::class, [
                'required' => false,
                'label' => 'user.last_name',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'action.save',
            ])
        ;
    }
}
