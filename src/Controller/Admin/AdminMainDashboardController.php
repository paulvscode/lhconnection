<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\SocialEvent;
use App\Repository\ProjectRepository;
use App\Repository\SocialEventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminMainDashboardController extends AbstractController
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private SocialEventRepository $socialEventRepository,
        private EntityManagerInterface $em
    )
    { }

    public function index(): Response
    {
        //  $user = $this->getUser();
        //  $username = $user->getUserIdentifier();

        // Username
        $username = "Example John";
        // Projects
        $projects = $this->projectRepository->findAll();
        // Social Events
        $events = $this->socialEventRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'username' => $username,
            'projects' => $projects,
            'events' => $events
        ]);
    }
}
