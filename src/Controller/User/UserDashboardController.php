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

        $allProjects = $entityManager->getRepository(Project::class)->findAll();

        $user = $this->getUser();
        $username = $user->getUsername();

        return $this->render('user/user_dashboard/index.html.twig', [
            'username' => $username,
            'projects' => $allProjects,
        ]);
    }
}

