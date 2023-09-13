<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NouveauController extends AbstractController
{
    #[Route('/nouveau', name: 'app_nouveau')]
    public function index(): Response
    {
        return $this->render('nouveau/index.html.twig', [
            'controller_name' => 'symfony',
            'sous_titre' => 'framework php',
            'stagiaires' => ['Vitoria', 'Senem', 'Margot'],
            'produit' =>[
                'nom' => 'Citron',
                'prix' => 3
            ],

            'dateToday' => new DateTime()
        ]);
    }
}
