<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $impersonate = Action::new('impersonate')
            ->linkToUrl(function (User $entity) {
                return $this->urlGenerator->generate('user_profile_view', ['_switch_user' => $entity->getEmail()]);
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $impersonate);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->hideNullValues();
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('firstName', 'user.first_name');
        yield TextField::new('middleName', 'user.middle_name')->hideOnIndex();
        yield TextField::new('lastName', 'user.last_name');
        yield EmailField::new('email', 'user.email');
        yield TextField::new('instrumentName', 'user.instrument')->hideOnForm();
        yield AssociationField::new('instrument', 'user.instrument')->autocomplete()->hideOnIndex();
    }
}
