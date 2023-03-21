<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class AccueilController extends AbstractController
{
    #[Route('/{_locale}/', name: 'app_accueil')]
    public function index(Request $request, TranslatorInterface $translator): Response
    {
        $locale = $request->getLocale();
        $message = $translator->trans('Symfony is great');

        return $this->render('accueil/index.html.twig', [
            'message' => $message,
            'locale' => $locale
        ]);
    }
}
