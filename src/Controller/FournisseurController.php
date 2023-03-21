<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FournisseurController extends AbstractController
{
    #[Route('/fournisseur', name: 'app_fournisseur')]
    public function index(): Response
    {
        return $this->render('fournisseur/index.html.twig', [
            'controller_name' => 'FournisseurController',
        ]);
    }

    #[Route('/fournisseur/new', name: 'app_fournisseur_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($fournisseur);
            $entityManager->flush();

            return $this->redirectToRoute('app_fournisseur_new');
        }

        return $this->render('fournisseur/new.html.twig', [
            'form'=> $form->createView(),
        ]);
    }
}
