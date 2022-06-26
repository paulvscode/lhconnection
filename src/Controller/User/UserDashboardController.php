<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserDashboardController extends AbstractController
{
    public function index(): Response
    {
        $user = $this->getUser();
        $username = $user->getUsername();

        return $this->render('user/user_dashboard/index.html.twig', [
            'username' => $username
        ]);
    }
}
