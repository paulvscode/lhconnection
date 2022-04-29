<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\SocialEvent;
use App\Entity\Team;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Administration')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('logolh.png')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Projects', 'fas fa-list', Project::class);
        yield MenuItem::linkToCrud('Social Events', 'fas fa-list', SocialEvent::class);
        yield MenuItem::linkToCrud('Team', 'fas fa-list', Team::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);


    }
}
