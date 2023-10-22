<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresenceIndividuelleController extends AbstractController
{
    #[Route('/presence/individuelle/{id_joueur}', name: 'presence_individuelle')]
    public function index(ManagerRegistry $doctrine, Request $req)
    {   
        $em = $doctrine->getManager();

        
        // Récupérez le joueur en fonction de l'ID du joueur
        $joueur = $em->getRepository(Personne::class)->find($req->get('id_joueur'));
        
        // Récupérez les présences du joueur
        $presences = $joueur->getPresences();


        // $equipeId = $joueur->getEquipesJoueur()->getId();
        // $equipe = $em->getRepository(Equipe::class)->find($equipeId);
        
        // Initialisez un tableau pour stocker les présences par état
        $presenceEtat = [];
        
        // Initialisez un tableau des états
        $etats = ['P', 'A', 'E', 'B', 'R'];
        
        // Remplissez le tableau des présences par état
        foreach ($etats as $etat) {
            $presenceCount = 0;
                foreach ($presences as $presence) {
                    if ($presence->getEtat() === $etat) {
                        $presenceCount++;
                    }
                }
                    $presenceEtat[$etat] = $presenceCount;
                }
                
                $vars = ['joueur' => $joueur,
                'etats' => $etats,
                'presenceEtat' => $presenceEtat];
                
                return $this->render('presence_individuelle/index.html.twig', $vars);
    }
}