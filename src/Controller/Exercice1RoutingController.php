<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Exercice1RoutingController extends AbstractController 
{

    //notre première action!!
    #[Route('/exercice1/routing/accueil')]
    public function accueil(){
        //dd ("Accueil Exercice1");
        return new Response("<h3> Bonjour, je suis dans le controller</h3>");
    }
    
}