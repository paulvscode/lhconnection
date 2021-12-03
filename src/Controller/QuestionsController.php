<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController
{
    #[Route('/questions', name: 'questions_')]
    public function index(): Response
    {
        return $this->render('questions/index.html.twig');
    }
}
