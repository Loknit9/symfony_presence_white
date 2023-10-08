<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route("/gestion/home_admin", name:"home_admin")]
    public function homeadmin()
    {
        return $this->render('gestion/homeadmin.html.twig');
    }

    #[IsGranted('ROLE_COACH')]
    #[Route("/gestion/home_coach", name:"home_coach")]
    public function homecoach()
    {
        return $this->render('gestion/homecoach.html.twig');
    }

}
