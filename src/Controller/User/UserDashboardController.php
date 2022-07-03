<?php

namespace App\Controller\User;

use App\Entity\Team;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDashboardController extends AbstractController
{
    public function index(ManagerRegistry $doctrine, Request $request, EntityManagerInterface $entityManager): Response
    {


        if (!empty($request->get('usersort'))) {
            $userSearch = $request->get('usersort');
            $teamMembersSorted = $doctrine->getRepository(Team::class)->findOneBySomeField($userSearch);
        };

        $user = $this->getUser();
        $username = $user->getUsername();

        if (!empty ($teamMembersSorted)) {
            $teamMembers = $teamMembersSorted;
        } else {
            $teamMembers = $doctrine->getRepository(Team::class)->findAll();
        }

        return $this->render('user/user_dashboard/index.html.twig', [
            'username' => $username,
            'teamMembers' => $teamMembers
        ]);
    }
}

