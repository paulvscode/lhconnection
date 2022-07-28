<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\Responsible;
use App\Entity\SocialEvent;
use App\Entity\User;
use App\Form\EventType;
use App\Form\ProjectType;
use App\Form\ResponsibleType;
use App\Form\UserType;
use App\Repository\ProjectRepository;
use App\Repository\ResponsibleRepository;
use App\Repository\SocialEventRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMainDashboardController extends AbstractController
{
    public function __construct(
        private ProjectRepository      $projectRepository,
        private SocialEventRepository  $socialEventRepository,
        private UserRepository         $userRepository,
        private ResponsibleRepository $responsibleRepository,
        private EntityManagerInterface $em
    )
    {
    }

    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $archivedProjects = $this->projectRepository->findBy(['archived' => true]);
        $archivedEvents = $this->socialEventRepository->findBy(['archived' => true]);
        $onlineProjects = $this->projectRepository->findBy(['archived' => false]);
        $onlineEvents = $this->socialEventRepository->findBy(['archived' => false]);

        return $this->render('admin/index.html.twig', [
            'username' => $username,
            'archivedProjects' => $archivedProjects,
            'archivedEvents' => $archivedEvents,
            'onlineProjects' => $onlineProjects,
            'onlineEvents' => $onlineEvents
        ]);
    }

    // projects
    public function projectEdit(Request $request, Project $project): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/project.edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'username' => $username,
        ]);
    }

    public function projectNew(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($project);
            $this->em->flush();
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/project.new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'username' => $username,
        ]);
    }

    public function projectDelete(Project $project)
    {
        $this->em->remove($project);
        $this->em->flush();

        return $this->redirectToRoute('admin_dashboard');
    }

    public function projectArchived(Project $project): Response
    {
        $project->setArchived(true);

        $this->em->persist($project);
        $this->em->flush();
        return $this->redirectToRoute('admin_dashboard');
    }

    public function projectUnarchived(Project $project): Response
    {
        $project->setArchived(false);

        $this->em->persist($project);
        $this->em->flush();
        return $this->redirectToRoute('admin_dashboard');
    }

    // events
    public function eventEdit(Request $request, SocialEvent $event): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/event.edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'username' => $username,
        ]);
    }

    public function eventNew(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $event = new SocialEvent();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($event);
            $this->em->flush();
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/event.new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'username' => $username,
        ]);
    }

    public function eventDelete(SocialEvent $event)
    {
        $this->em->remove($event);
        $this->em->flush();

        return $this->redirectToRoute('admin_dashboard');
    }

    public function eventArchived(SocialEvent $event): Response
    {
        $event->setArchived(true);

        $this->em->persist($event);
        $this->em->flush();
        return $this->redirectToRoute('admin_dashboard');
    }

    public function eventUnarchived(SocialEvent $event): Response
    {
        $event->setArchived(false);

        $this->em->persist($event);
        $this->em->flush();
        return $this->redirectToRoute('admin_dashboard');
    }

//    Users

    public function manageUsers(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $users = $this->userRepository->findAll();
        $responsibles = $this->responsibleRepository->findAll();

        return $this->render('admin/usersmanaging.html.twig', [
            'username' => $username,
            'users' => $users,
            'responsibles' => $responsibles
        ]);
    }

    public function userEdit(Request $request, User $websiteUser): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $form = $this->createForm(UserType::class, $websiteUser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('manage_users');
        }

        return $this->render('admin/useredit.html.twig', [
            'user' => $websiteUser,
            'form' => $form->createView(),
            'username' => $username
        ]);
    }

    public function responsibleEdit(Request $request, Responsible $responsible): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $username = $user->getEmail();

        $form = $this->createForm(ResponsibleType::class, $responsible);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('manage_users');
        }

        return $this->render('admin/useredit.html.twig', [
            'user' => $responsible,
            'form' => $form->createView(),
            'username' => $username
        ]);
    }
}
