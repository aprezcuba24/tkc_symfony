<?php

namespace App\Controller\Admin;

use App\Entity\Package;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PackageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Package::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('code'),
            TextEditorField::new('description'),
            ChoiceField::new('type'),
            NumberField::new('weight'),
            NumberField::new('volumen'),
        ];
    }
}
