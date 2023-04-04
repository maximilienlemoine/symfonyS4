<?php

namespace App\Event;

use App\Entity\Adresse;

class AdresseEvent
{
    const NAME = 'adresse.created';

    private $adresse;

    public function __construct(Adresse $adresse)
    {
        $this->adresse = $adresse;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }
}