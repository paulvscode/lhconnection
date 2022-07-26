<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Repository\ProjectRepository;
use App\Repository\SocialEventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserMainDashboardController extends AbstractController
{
    public function __construct(
        private ProjectRepository      $projectRepository,
        private SocialEventRepository  $socialEventRepository,
        private EntityManagerInterface $em
    )
    {
    }

    public function index()
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $archivedProjects = $this->projectRepository->findBy(['archived' => true]);
        $archivedEvents = $this->socialEventRepository->findBy(['archived' => true]);
        $onlineProjects = $this->projectRepository->findBy(['archived' => false]);
        $onlineEvents = $this->socialEventRepository->findBy(['archived' => false]);

        return $this->render('user/index.html.twig', [
            'username' => $username,
            'archivedProjects' => $archivedProjects,
            'archivedEvents' => $archivedEvents,
            'onlineProjects' => $onlineProjects,
            'onlineEvents' => $onlineEvents
        ]);
    }
}