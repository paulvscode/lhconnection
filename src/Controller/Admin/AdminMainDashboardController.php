<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\SocialEvent;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminMainDashboardController extends AbstractController
{
    public function index(ManagerRegistry $doctrine): Response
    {
        //  $user = $this->getUser();
        //  $username = $user->getUserIdentifier();

        // Username
        $username = "Example John";
        // Projects
        $projects = $doctrine->getRepository(Project::class)->findAll();
        // Social Events
        $events = $doctrine->getRepository(SocialEvent::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'username' => $username,
            'projects' => $projects
        ]);
    }
}
