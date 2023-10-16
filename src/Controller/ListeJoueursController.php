<?php

namespace App\Controller;

use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeJoueursController extends AbstractController
{
    #[Route('/liste/joueurs/{date}/{id_equipe}', name: 'liste_joueurs')]
    public function listeJoueurs (Request $req){
        $date = $req->get ('date');
        $id_equipe = $req->get('id');

        dd(new DateTime($date));
        
        //return $this->render('liste_joueurs/index.html.twig');
    }
}
