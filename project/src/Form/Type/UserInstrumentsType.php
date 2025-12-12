<?php

namespace App\Form\Type;

use App\Entity\Instrument;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserInstrumentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('instrument', EntityType::class, [
                'label' => 'user.instrument',
                'class' => Instrument::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');
                },
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => false,
            ])
            ->add('instruments', EntityType::class, [
                'label' => 'user.instruments',
                'class' => Instrument::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'action.save',
            ])
        ;
    }
}
