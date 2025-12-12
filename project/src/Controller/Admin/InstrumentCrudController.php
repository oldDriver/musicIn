<?php

namespace App\Controller\Admin;

use App\Entity\Instrument;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InstrumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Instrument::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('type')->hideOnIndex();
        yield TextField::new('name');
        yield DateTimeField::new('createdAt')->hideOnForm();
    }
}
