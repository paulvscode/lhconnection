<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminMainDashboardController extends AbstractController
{
    public function index(): Response
    {
        $user = $this->getUser();
        $username = $user->getUserIdentifier();

        return $this->render('admin/index.html.twig', [
            'username' => $username
        ]);
    }
}
