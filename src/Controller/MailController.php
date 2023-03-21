<?php

namespace App\Controller;

use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    #[Route('/mail', name: 'mail')]
    public function index(MailService $mailService): Response
    {
        $mailService->sendEmail('destinataire@mail.com', 'Test', 'Paco tu parles la ?');

        return $this->render('mail/index.html.twig', []);

    }
}
