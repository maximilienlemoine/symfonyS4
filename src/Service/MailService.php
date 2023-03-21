<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $destinataire,string $sujet,string $corps)
    {
        $email = (new Email())
            ->from('maximilien-lemoine@mail.com')
            ->to($destinataire)
            ->subject($sujet)
            ->text($corps)
            ->html($corps);

        $this->mailer->send($email);
    }
}