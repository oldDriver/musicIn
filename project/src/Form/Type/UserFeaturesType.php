<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserFeaturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('singer', CheckboxType::class, [
                'required' => false,
            ])
            ->add('songwriter', CheckboxType::class, [
                'required' => false,
            ])
            ->add('composer', CheckboxType::class, [
                'required' => false,
            ])
            ->add('arranger', CheckboxType::class, [
                'required' => false,
            ])
            ->add('conductor', CheckboxType::class, [
                'required' => false,
            ])

            ->add('save', SubmitType::class, [
                'label' => 'action.save',
            ])
        ;
    }
}
