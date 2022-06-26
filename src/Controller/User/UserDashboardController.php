<?php

namespace App\Controller\User;

use App\Entity\Team;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserDashboardController extends AbstractController
{
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $username = $user->getUsername();
        $teamMembers = $doctrine->getRepository(Team::class)->findAll();


        return $this->render('user/user_dashboard/index.html.twig', [
            'username' => $username,
            'teamMembers' => $teamMembers
        ]);
    }
}
