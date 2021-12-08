<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin_event', name: 'admin_event_')]
class AdminEventController extends AbstractController
{

    private EventRepository $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $events = $this->repository->findAll();

        return $this->render('admin/event/index.html.twig', compact('events'));
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Event $id, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(EventType::class, $id);

        $entityManager = $doctrine->getManager();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('admin_event_index');
        }

        return $this->render('admin/event/edit.html.twig', [
            'event' => $id,
            'form' => $form->createView()
        ]);
    }

}