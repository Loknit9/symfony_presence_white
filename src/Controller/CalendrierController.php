<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{
    #[Route('/calendrier', name: 'calendrier')]
    public function index(): Response
    {

        // envoyer l'id de l'equipe 
        // date de l'evenement

        return $this->render('calendrier/index.html.twig');
    }
}
