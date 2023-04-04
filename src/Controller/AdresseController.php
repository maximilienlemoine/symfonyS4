<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{
    #[Route('/adresse/10000', name: 'app_adresse')]
    public function index(AdresseRepository $adresseRepository): Response
    {
        $adresses = $adresseRepository->findByCodePostalOrderByRue(10000);

        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresses,
        ]);
    }

    #[Route('/adresse/new', name: 'app_adresse_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($adresse);
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_new');
        }

        return $this->render('adresse/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
