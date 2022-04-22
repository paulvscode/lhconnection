<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
//    #[Route('/', name: 'homepage_')]
//    public function index(ArticleRepository $articleRepository): Response
//    {
//        $articles = $articleRepository->findAll();
//
//        return $this->render('homepage/index.html.twig', [
//            'articles' => $articles
//        ]);
//    }

    #[Route('/', name: 'homepage_')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('second_ver/index.html', []);
    }
}
