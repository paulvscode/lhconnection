<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\SocialEvent;
use App\Form\EventType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\SocialEventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $username = "Example John";

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('futur_dashboard');
        }

        return $this->render('admin/project.edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'username' => $username,
        ]);
    }

    public function projectNew(Request $request)
    {
        $username = "Example John";

        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($project);
            $this->em->flush();
            return $this->redirectToRoute('futur_dashboard');
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

        return $this->redirectToRoute('futur_dashboard');
    }

    public function projectArchived(Request $request): Response
    {
        $currId = $request->get('id');
        $currProject = $this->projectRepository->findOneBy(['id' => $currId]);
        $currProject->setArchived(true);

        $this->em->persist($currProject);
        $this->em->flush();
        return $this->redirectToRoute('futur_dashboard');
    }

    public function projectUnarchived(Request $request): Response
    {
        $currId = $request->get('id');
        $currProject = $this->projectRepository->findOneBy(['id' => $currId]);
        $currProject->setArchived(false);

        $this->em->persist($currProject);
        $this->em->flush();
        return $this->redirectToRoute('futur_dashboard');
    }

    // events
    public function eventEdit(Request $request, SocialEvent $event): Response
    {
        $username = "Example John";

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('futur_dashboard');
        }

        return $this->render('admin/event.edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'username' => $username,
        ]);
    }

    public function eventNew(Request $request)
    {
        $username = "Example John";

        $event = new SocialEvent();

        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($event);
            $this->em->flush();
            return $this->redirectToRoute('futur_dashboard');
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

        return $this->redirectToRoute('futur_dashboard');
    }

    public function eventArchived(Request $request): Response
    {
        $currId = $request->get('id');
        $currEvent = $this->socialEventRepository->findOneBy(['id' => $currId]);
        $currEvent->setArchived(true);

        $this->em->persist($currEvent);
        $this->em->flush();
        return $this->redirectToRoute('futur_dashboard');
    }

    public function eventUnarchived(Request $request): Response
    {
        $currId = $request->get('id');
        $currEvent = $this->socialEventRepository->findOneBy(['id' => $currId]);
        $currEvent->setArchived(false);

        $this->em->persist($currEvent);
        $this->em->flush();
        return $this->redirectToRoute('futur_dashboard');
    }
}
