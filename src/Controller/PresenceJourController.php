<?php

namespace App\Controller;

use DateTime;
use App\Entity\Equipe;
use App\Entity\Evenement;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresenceJourController extends AbstractController
{
    #[Route('/presence/jour/{date_evenement}/{id_equipe}/{title}/{id_event}', name: 'presence_jour')]
    public function presenceJour(ManagerRegistry $doctrine, Request $req)
    {

        $em = $doctrine->getManager();
        
        // obtenir l'equipe qui correspond au paramètre nom
        $rep = $em->getRepository(Equipe::class);

        $equipe = $rep->find($req->get('id_equipe'));

        $startDate = $req->get('date_evenement');
        $start = new DateTime($startDate);

        $title = $req->get('title');
        
        $id_equipe = $req->get('id_equipe');
        
        $evenement = $req->get('id_event');

        //recupérer les joueurs de cette équipe
        $joueurs = $equipe->getJoueurs();


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
                    if ($presence->getEtat() === $etat && $presence->getEvenement() === $title) {
                        $presenceStart = $presence->getEvenement()->getStart();
                        if ($presenceStart !== null && $presenceStart->format('Y-m-d') === $start->format('Y-m-d')) {
                            $count++;
                        }
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

        $vars = ['result'=>$result, 'equipe' => $equipe, 'id_equipe'=> $id_equipe, 'start'=>$start, 'title'=>$title, 'etats' => $etats, ];

        return $this->render('presence_jour/presencejour.html.twig', $vars);
    }
}
