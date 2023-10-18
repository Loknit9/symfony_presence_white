<?php

namespace App\Controller;

use DateTime;
use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeJoueursController extends AbstractController
{
    #[Route('/liste/joueurs/{date}/{id_equipe}', name: 'liste_joueurs')]
    public function listejoueurs(ManagerRegistry $doctrine, Request $req)
    {
      
        $em = $doctrine->getManager();

        // obtenir l'equipe qui correspond au paramètre nom
        $rep = $em->getRepository(Equipe::class);

        $equipe = $rep ->find($req->get('id_equipe'));
       

        //obtenir la liste des joueurs de l'equipe
        $listeJoueurs = $equipe->getJoueurs();
      
       

        // afficher ds la vue la liste des joueurs
        $vars = ['listeJoueurs' => $listeJoueurs,'equipe' => $equipe ];
       
       return $this->render('liste_joueurs/index.html.twig', $vars);
       
       
           
       
       
       
       
       
       
       
       // $date = $req->get ('date');
        //$id_equipe = $req->get('id');

        // dd(new DateTime($date));
        
        //return $this->render('liste_joueurs/index.html.twig');
    }
}
