<?php

namespace App\Controller\Admin;

use App\Entity\Package;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminAction;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;

class PackageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Package::class;
    }

    #[AdminAction(routePath: '/send-to-transport', routeName: 'send_to_transport', methods: ['GET', 'POST'])]
    public function sendToTransport(AdminContext $context): Response {
        $package = $context->getEntity()->getInstance();
        
        $this->addFlash('success', 'Package sent to transport successfully ' . $package->getCode());
        $url = $this->generateUrl('admin_package_index');
        return $this->redirect($url);
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

    public function configureActions(Actions $actions): Actions {
        $sendToTransport = Action::new(
            'sendToTransport',
            'Send To Transport',
            'fa fa-send'
        )
            ->linkToCrudAction('sendToTransport');
        return $actions->add(Crud::PAGE_INDEX, $sendToTransport);
    }
}
