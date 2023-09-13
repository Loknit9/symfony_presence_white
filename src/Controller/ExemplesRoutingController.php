<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExemplesRoutingController extends AbstractController 
{

    //notre première action!!
    #[Route('/exemples/routing/accueil')]
    public function accueil(){
        dd ("Accueil Heavy Metal");
    }

    //action qui reçoit des paramètres
    #[Route('/exemples/routing/bonjour/nom/{nom}/{age}')]
    public function bounjourNom(Request $req){
        //dump($req->get('nom'));
        //dd($req->get('age'));
        return new Response ("<br>Bonjour " . $req->get('nom') .", " . $req->get('age'));
    }

    //action qui reçoit le prix en paramètre et qui affiche le prix TVAC (avec response)
    #[Route('exemples/routing/afficherprix/{prix}')]
    public function prixTVAC(request $req){
        return new Response("<br> Le prix TVAC est " . $req->get('prix') * 1.21);
    }

    #[Route('exemples/routing/afficherprixettva/{prix}/{tva}')]
    public function prixettva(request $req){
        return new Response("<br> Le prix TVAC est " . $req->get('prix') * 1.21 . " taux " . $req->get('tva') . "%");
    }

    //action qui affiche une vue
    #[Route('/exemples/routing/affiche/vue')]
    public function afficheVue(){
        return $this->render("/exemples_routing/affiche_vue.html.twig");
    }

    //action qui affiche une vue 2
    #[Route('/exemples/routing/affiche/autre/vue')]
    public function afficheVue2(){
        return $this->render("/autre_exemples_routing/affiche_vue_2.html.twig");
    }

    
}