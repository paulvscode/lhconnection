<?php

namespace App\Controller\AdminSelf;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BackEndProjectController extends AbstractController
{
    private ProjectRepository $repository;
    private EntityManagerInterface $em;

    public function __construct(ProjectRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function index()
    {
        // $user = $this->getUser();
        // $username = $user->getUsername();

        $username = 'John Le temporaire';

        $allProjects = $this->repository->findAll();
        return $this->render('adminSelf/index.html.twig', [
            'projects' => $allProjects,
            'username' => $username
        ]);
    }

    public function new(Request $request)
    {
        $username = 'John Le temporaire';

        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($project);
            $this->em->flush();
            return $this->redirectToRoute('adminself');
        }

        return $this->render('adminSelf/create.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'username' => $username
        ]);
    }

    public function edit(Project $project, Request $request)
    {

        // $user = $this->getUser();
        // $username = $user->getUsername();

        $username = 'John Le temporaire';


        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('adminself');
        }

        return $this->render('adminSelf/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
            'username' => $username
        ]);
    }
}