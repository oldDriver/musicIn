<?php

namespace App\Form\Type;

use App\Entity\Genre;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class UserGenresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('genres', EntityType::class, [
                'label' => 'user.genres',
                'class' => Genre::class,
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
