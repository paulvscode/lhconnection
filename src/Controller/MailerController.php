<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailerController extends AbstractController
{
    #[Route('/email', name: 'email')]
    public function sendEmail(MailerInterface $mailer, Request $request): Response
    {
        $nameR = $request->get('name');
        $emailR = $request->get('email');
        $subjectR = $request->get('subject');
        $messageR = $request->get('message');

        if ($_POST['comment'] != "")
        {
            die('oops');
        }

        $email = (new TemplatedEmail())
            ->from('contact@lhconnections.com')
            ->to('contact@lhconnections.com')
            ->subject($subjectR)
            ->text($messageR)
            ->htmlTemplate('emails/model.html.twig')
            ->context([
                'name' => $nameR,
                'emailSender' => $emailR,
                'subject' => $subjectR,
                'message' => $messageR,
            ]);



        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            dd($e);
        }

        $this->addFlash('success', 'Email bien envoyé');
        return $this->redirectToRoute('homepage');
    }
}
