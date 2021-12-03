<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WhoAreWeController extends AbstractController
{
    #[Route('/who', name: 'who_')]
    public function index(): Response
    {
        return $this->render('who/index.html.twig');
    }
}
