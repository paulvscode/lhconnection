<?php

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserMainDashboardController extends AbstractController
{
    public function index()
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('calendar/calendar.html.twig');
    }
}