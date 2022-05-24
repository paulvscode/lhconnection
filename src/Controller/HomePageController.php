<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\SocialEvent;
use App\Entity\Team;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'homepage_')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $locale = $request->getLocale();

        $colorsClass = ['blue', 'orange', 'green', 'red', 'purple', 'pink'];
        $socialEvents = $doctrine->getRepository(SocialEvent::class)->findAll();
        $teamMembers = $doctrine->getRepository(Team::class)->findAll();
        $projects = $doctrine->getRepository(Project::class)->findAll();

        return $this->render('base.html.twig', [
            'teamMembers' => $teamMembers,
            'socialEvents' => $socialEvents,
            'colors' => $colorsClass,
            'projects' => $projects,
            'locale' => $locale
        ]);

//        return $this->render('wip.html.twig');
    }

    #[Route('/confidentialite', name: 'confidentialite')]
    public function rgpd(): Response
    {
        return $this->render('confidentialite.html.twig');
    }
}
