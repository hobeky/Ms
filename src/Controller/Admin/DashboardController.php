<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Entity\Food;
use App\Entity\FoodDay;
use App\Entity\FoodWeek;
use App\Entity\Gallery;
use App\Entity\Hero;
use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
//        return parent::index();

//         Option 1. You can make your dashboard redirect to some common page of your backend

         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(TeacherCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

//         Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
//         (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)

         return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Ucitelia', 'fa fa-home');
         yield MenuItem::linkToCrud('Galeria', 'fas fa-list', Gallery::class);
         yield MenuItem::linkToCrud('Banner obrazky', 'fas fa-list', Hero::class,);
         yield MenuItem::linkToCrud('Event', 'fas fa-list', Event::class);
         yield MenuItem::linkToCrud('Menu', 'fas fa-list', FoodWeek::class);
    }
}
