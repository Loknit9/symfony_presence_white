<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


// mauvaise solution pour cet exercice: la phrase "le prix TVAC est de ... " doit être dans la vue//
//il faut créer des variables ds //
//voir code de Leal//

class ExercicesVuesController extends AbstractController
{
    #[Route('/exercices/vues/{prix}/{tva}')]
    public function exercice1(Request $req): Response
    {
        return $this->render('exercices_vues/exercice1.html.twig', [
            'controller_name' => 'ExercicesVuesController',
            'prixTvac' => ("Le prix TVAC est " . $req->get('prix') * 1.21 . " taux " . $req->get('tva') . "%"),
            'prixTaux' => ("Le prix de " . $req->get('prix') . " euros avec le taux de " . $req->get('tva') . "% est de " . $req->get('prix') * 1.21 ." euros"),
        ]);
    }


    //exercice 2 

    #[Route('/exercices/vues/exercice2/{prix}/{tva}')]
    public function exercice2 (Request $req): Response
    {
        $prix = $req->get('prix');
        $tva = $req->get('tva');
        $prixTva = $prix * (1+$tva/100);

        return $this -> render('exercices_vues/exercice2.html.twig', 
        [
            'prix' =>$prix,
            'tva' =>$tva,
            'prixTva' =>$prixTva,
        ]);
    }



    //exercice 3

    #[Route('/exercices/vues/exercice3')]
    public function exercice3(): Response{
        return $this->render('exercices_vues/exercice3.html.twig');
    }

    //exercice 4
    #[Route('/exercices/vues/exercice4')]
    public function exercice4(): Response{

        $tabVilles = ['Bruges', 'Bruxelles', 'Bruly'];

        $vars = ['tabVilles' => $tabVilles];

        return $this ->render('exercices_vues/exercice4.html.twig',
            $vars
        );

    }
}
