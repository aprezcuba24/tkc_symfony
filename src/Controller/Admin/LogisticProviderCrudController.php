<?php

namespace App\Controller\Admin;

use App\Entity\LogisticProvider;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LogisticProviderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LogisticProvider::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            ChoiceField::new('type'),
        ];
    }
}
