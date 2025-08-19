<?php

namespace App\Controller\Admin;

use App\Entity\Driver;
use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Entity\Place;
use App\Entity\LogisticProvider;
use App\Entity\Package;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        return $this->redirectToRoute('admin_package_index');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Workspace');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Packages', 'fas fa-box', Package::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Places', 'fas fa-location-dot', Place::class);
        yield MenuItem::linkToCrud('Logistic Providers', 'fas fa-truck', LogisticProvider::class);
        yield MenuItem::linkToCrud('Drivers', 'fas fa-user', Driver::class);
        yield MenuItem::linkToCrud('Orders', 'fas fa-file', Order::class);
    }
}
