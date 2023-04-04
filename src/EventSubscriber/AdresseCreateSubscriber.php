<?php

namespace App\EventSubscriber;

use App\Event\AdresseEvent;
use App\Service\MailService;

class AdresseCreateSubscriber
{
    public function __construct(
        MailService $mailer
    ) {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            AdresseEvent::NAME => 'onAdresseCreated',
        ];
    }

    public function onAdresseCreated(AdresseEvent $event)
    {
        if ($event) {
            $this->mailer->sendEmail('symfonys4@mail.com', 'test@mail.com', 'Test', 'Test', 'Test');
        }}
}