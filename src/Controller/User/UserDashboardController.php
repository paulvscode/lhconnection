<?php

namespace App\Controller\User;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDashboardController extends AbstractController
{
    public function index(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $username = $user->getUsername();

        if (!empty($request->query->get('projectsort'))) {
            $projectSorting = $request->query->get('projectsort');
            $sortedProject = $entityManager->getRepository(Project::class)->findOneBySomeField($projectSorting);
        } else {
            $sortedProject = $entityManager->getRepository(Project::class)->findAll();
        }

        return $this->render('adminSelf/index.html.twig', [
            'username' => $username,
            'projects' => $sortedProject
        ]);
    }

    public function account()
    {
        $user = $this->getUser();
        $username = $user->getUsername();

        return $this->render('user/user_dashboard/account.html.twig', [
            'username' => $username
        ]);
    }
}

