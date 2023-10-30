<?php

namespace App\Controller;

use DateTime;
use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresenceJourController extends AbstractController
{
    #[Route('/presence/jour/{date_evenement}/{id_equipe}/{title}', name: 'presence_jour')]
    public function presenceJour(ManagerRegistry $doctrine, Request $req)
    {

        $em = $doctrine->getManager();
        
        // obtenir l'equipe qui correspond au paramètre nom
        $rep = $em->getRepository(Equipe::class);

        $equipe = $rep->find($req->get('id_equipe'));
        $date = $req->get('date_evenement');

        $dateEvent = (new DateTime($date));
        
        // $evenementType = $req->get('type');

        $id_equipe = $req->get('id_equipe');
        
        //recupérer les joueurs de cette équipe
        $joueurs = $equipe->getJoueurs();

        $evenementTitle = $req->get('title');

        // initialise les états des présences
        $etats = ['P', 'A', 'E', 'B', 'R']; 

        $result = [];
        
        //obtenir les presences des joueurs pour la date recupérée dans l'url //
        
        foreach ($joueurs as $joueur) {
            $joueurNom = $joueur->getPrenom() . ' ' . $joueur->getNom();
            $joueurId = $joueur->getId();
            
            $presenceCount = [];
        
            foreach ($etats as $etat) {
                $count = 0;
        
                // Filtrer les présences du joueur pour l'événement spécifique et la date donnée
                foreach ($joueur->getPresences() as $presence) {
                    if ($presence->getEtat() === $etat && $evenement->getStart() === $dateEvent && $presence->getEvenement() === $evenementTitle) {
                        $count++;
                    }
                }
        
                $presenceCount[$etat] = $count;
            }

            
        
            $result[$joueurId] = [
                'nom' => $joueur->getNom(),
                'prenom' => $joueur->getPrenom(),
                'presences' => $presenceCount,
            ];


        }

        $vars = ['result'=>$result, 'equipe' => $equipe, 'id_equipe'=> $id_equipe, 'date_evenement'=>$date, 'title'=>$evenementTitle ];

        return $this->render('presence_jour/presencejour.html.twig', $vars);
    }
}
