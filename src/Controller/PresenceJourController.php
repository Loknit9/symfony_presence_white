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
    #[Route('/presence/jour/{date_evenement}/{id_equipe}/{id_event}', name: 'presence_jour')]
    public function presenceJour(ManagerRegistry $doctrine, Request $req)
    {

    // afficher les présences d'un jour pour une equipe

        $em = $doctrine->getManager();

        // obtenir l'equipe qui correspond au paramètre url
        $rep = $em->getRepository(Equipe::class);
        $equipe = $rep->find($req->get('id_equipe'));

        // obtenir l'evenement qui correspond au paramètre url

        $evenementId = $req->get('id_event');
        $evenement = $em->getRepository(Evenement::class)->find($evenementId);

        // recupere date evenement

        $date = $evenement->getStart()->format('Y-m-d');

        //recupérer les joueurs de cette équipe
        $joueurs = $equipe->getJoueurs();

        // dd($evenement);

        // initialise les états des présences
        $etats = ['P', 'A', 'E', 'B', 'R'];

        $result = [];

        //obtenir les presences des joueurs pour la date recupérée dans l'url //
        if ($evenement !== null) {
            $presences = $evenement->getPresences(); // Récupérer toutes les présences pour cet événement

            foreach ($joueurs as $joueur) {
                $joueurId = $joueur->getId();
                $presenceCount = [];

                foreach ($etats as $etat) {
                    $count = 0;

                    foreach ($presences as $presence) {
                        $associatedEvent = $presence->getEvenement(); // Récupérer l'événement associé à cette présence

                        // Comparer les identifiants des événements au lieu des objets eux-mêmes
                        if ($associatedEvent !== null &&
                            $associatedEvent->getId() === $evenement->getId() &&
                            $presence->getJoueur() === $joueur &&
                            $associatedEvent->getStart()->format('Y-m-d') === $date &&
                            $presence->getEtat() === $etat) {
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
        


        $vars = ['result' => $result, 'equipe' => $equipe, 'id_equipe' => $req->get('id_equipe'), 'date' => $date, 'etats' => $etats,];

        if ($req->isXmlHttpRequest()) {
            // Si c'est une requête AJAX, renvoyer les données au format JSON
            return $this->json($vars);
        }

        return $this->render('presence_jour/affiche_jour.html.twig', $vars);
    }
}
    // supprimer les présences pour ce jour

    
}
