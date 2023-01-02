<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    public function postLoginRedirectAction() : Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return $this->forward('App\Controller\Admin\AdminMainDashboardController::index');
        } elseif (in_array('ROLE_USER', $user->getRoles())) {
                return $this->forward('App\Controller\User\UserMainDashboardController::index');
        } else {
            if (in_array('ROLE_CALENDAR', $user->getRoles()))  {
                return $this->forward('App\Controller\User\UserMainDashboardController::index');
            }
        }

        return $this->render('homepage/index.html.twig');
    }

    public function logout(): void
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
