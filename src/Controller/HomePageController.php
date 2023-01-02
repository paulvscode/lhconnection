<?php

namespace App\Controller;

use App\Entity\Club;
use App\Entity\News;
use App\Entity\Project;
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

        $responsibles = $doctrine->getRepository(Responsible::class)->findAll();
        $projects = $doctrine->getRepository(Project::class)->findAll();

        $onlineProjects = $doctrine->getRepository(Project::class)->findBy(['archived' => false]);
        $archivedProjects = $doctrine->getRepository(Project::class)->findBy(['archived' => true]);

        $onlineNews = $doctrine->getRepository(News::class)->findBy(['status' => false]);
        $archivedNews = $doctrine->getRepository(News::class)->findBy(['status' => true]);

        $onlineClubs = $doctrine->getRepository(Club::class)->findBy(['archived' => false]);
        $archivedClubs = $doctrine->getRepository(Club::class)->findBy(['archived' => true]);

        return $this->render('base.html.twig', [
            'responsibles' => $responsibles,
            'projects' => $projects,
            'locale' => $locale,
            'onlineProjects' => $onlineProjects,
            'archivedProjects' => $archivedProjects,
            'onlineNews' => $onlineNews,
            'archivedNews' => $archivedNews,
            'onlineClubs' => $onlineClubs,
            'archivedClubs' => $archivedClubs
        ]);
    }

    public function rgpd(): Response
    {
        return $this->render('confidentialite.html.twig');
    }

    public function challengeLhTampa(ManagerRegistry $doctrine, Request $request): Response
    {
        $locale = $request->getLocale();

        $colorsClass = ['blue', 'orange', 'green', 'red', 'purple', 'pink'];

        return $this->render('challenge/challenge.html.twig', [
            'colors' => $colorsClass,
            'locale' => $locale,
        ]);
    }


    public function calendar(Request $request)
    {
        if ($this->isGranted('ROLE_CALENDAR') == false) {
            $this->redirectToRoute('login');
        }

        $locale = $request->getLocale();

        return $this->render('calendar/calendar.html.twig');
    }
}


