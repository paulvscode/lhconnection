<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Entity\Project;
use App\Form\EventType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin_project', name: 'admin_project_')]
class AdminProjectController extends AbstractController
{

    private ProjectRepository $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $projects = $this->repository->findAll();

        return $this->render('admin/project/index.html.twig', compact('projects'));
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Project $id, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(ProjectType::class, $id);

        $entityManager = $doctrine->getManager();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('admin_project_index');
        }

        return $this->render('admin/project/edit.html.twig', [
            'event' => $id,
            'form' => $form->createView()
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();
            return $this->redirectToRoute('admin_project_index');
        }

        return $this->render('admin/project/create.html.twig', [
            'project' => $project,
            'form' => $form->createView()
        ]);
    }
}