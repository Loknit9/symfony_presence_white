<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionController extends AbstractController
{
    #[IsGranted('ROLE_COACH')]
    #[Route("/gestion/homecoach")]
    public function homecoach()
    {
        return $this->render('gestion/homecoach.html.twig');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route("/gestion/homeadmin")]
    public function homeadmin()
    {
        return $this->render('gestion/homeadmin.html.twig');
    }


}
