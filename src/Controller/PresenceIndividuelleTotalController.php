<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresenceIndividuelleTotalController extends AbstractController
{
    #[Route('/presence/individuelle/total', name: 'app_presence_individuelle_total')]
    public function index(): Response
    {
        return $this->render('presence_individuelle_total/index.html.twig', [
            'controller_name' => 'PresenceIndividuelleTotalController',
        ]);
    }
}
