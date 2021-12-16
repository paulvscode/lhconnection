<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin_article', name: 'admin_article_')]
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

    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $entityManager = $doctrine->getManager();
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('Image')->getData();

            if ($imageFile) {
                $originalFileName = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('image_directory'),
                        $newFileName
                    );
                } catch (FileException $e) {
//                    Handle exception here
                }

                $article->setImage($newFileName);

            }

            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('admin/article/create.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Article $article, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('admin_article_index');
    }
}