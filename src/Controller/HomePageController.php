<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/check', name: 'wip')]
    public function wip(): Response
    {
        return $this->render('base.html.twig', []);
    }

    #[Route('/', name: 'homepage_')]
    public function index(): Response
    {
        return $this->render('second_ver/index.html', []);
    }
}
