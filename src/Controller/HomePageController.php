<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\SocialEvent;
use App\Entity\Responsible;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomePageController extends AbstractController
{
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $locale = $request->getLocale();

        $colorsClass = ['blue', 'orange', 'green', 'red', 'purple', 'pink'];
        $socialEvents = $doctrine->getRepository(SocialEvent::class)->findAll();
        $responsibles = $doctrine->getRepository(Responsible::class)->findAll();
        $projects = $doctrine->getRepository(Project::class)->findAll();

        $onlineProjects = $doctrine->getRepository(Project::class)->findBy(['archived' => false]);
        $archivedProjects = $doctrine->getRepository(Project::class)->findBy(['archived' => true]);

        $onlineEvents = $doctrine->getRepository(SocialEvent::class)->findBy(['archived' => false]);
        $archivedEvents = $doctrine->getRepository(SocialEvent::class)->findBy(['archived' => true]);

        return $this->render('base.html.twig', [
            'responsibles' => $responsibles,
            'socialEvents' => $socialEvents,
            'colors' => $colorsClass,
            'projects' => $projects,
            'locale' => $locale,
            'onlineProjects' => $onlineProjects,
            'archivedProjects' => $archivedProjects,
            'onlineEvents' => $onlineEvents,
            'archivedEvents' => $archivedEvents
        ]);

//        return $this->render('wip.html.twig');
    }

    public function rgpd(): Response
    {
        return $this->render('confidentialite.html.twig');
    }

    public function challengeLhTampa(): Response {
        return $this->render('challenge/challenge.html.twig');
    }

}
