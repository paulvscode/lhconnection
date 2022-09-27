<?php

namespace App\Controller\User;

use App\Entity\Project;
use App\Entity\User;
use App\Repository\ClubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserMainDashboardController extends AbstractController
{
    public function __construct(
        private ClubRepository $clubRepository,
        private EntityManagerInterface $em
    )
    {
    }

    public function index()
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $clubs = $this->clubRepository->findAll();

        return $this->render('user/index.html.twig', [
            'username' => $username,
            'clubs' => $clubs
        ]);
    }
}