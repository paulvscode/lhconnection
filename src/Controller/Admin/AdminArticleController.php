<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article', name: 'admin_article_')]
class AdminArticleController extends AbstractController
{

    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $articles = $this->repository->findAll();

        return $this->render('admin/article/index.html.twig', compact('articles'));
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Article $id, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(ArticleType::class, $id);

        $entityManager = $doctrine->getManager();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('admin/article/edit.html.twig', [
            'article' => $id,
            'form' => $form->createView()
        ]);
    }

}