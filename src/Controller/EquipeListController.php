<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EquipeListController extends AbstractController
{   
    #[Route('/equipe/list/{categorieAge}/{categorieGenre}/{nom}', name: 'equipe_list')]
    public function listejoueurs(ManagerRegistry $doctrine, $categorieAge, $categorieGenre, $nom)
    {
                
        $em = $doctrine->getManager();
        // obtenir l'equipe qui correspond aux paramètres
        $query = $em->createQuery('SELECT equipe, joueurs FROM App\Entity\Equipe equipe' 
                    . ' JOIN equipe.joueurs joueurs');
        
        $listJoueurs = $query->getResult();

        //obtenir la liste des joueurs de l'equipe
        
        // afficher ds la vue la liste des joueurs
        $vars = ['equipe' => $listJoueurs];

        return $this->render('equipe_list/index.html.twig', $vars);
    }
}
