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
        


        $vars = ['result' => $result, 'equipe' => $equipe, 'id_equipe' => $req->get('id_equipe'), 'date' => $date, 'etats' => $etats,'evenement'=>$evenement, 'id_event'=>$evenementId];

        if ($req->isXmlHttpRequest()) {
            // Si c'est une requête AJAX, renvoyer les données au format JSON
            return $this->json($vars);
        }

        return $this->render('presence_jour/affiche_jour.html.twig', $vars);
    }
}
    // supprimer les présences pour ce jour

    #[Route('/presence/jour/delete/{id_equipe}/{id}', name: 'presenceJour_delete')]
    public function PrsenceJourDelete(Request $req, ManagerRegistry $doctrine)
    {

        //recuperer id equipe pour l'envoyer dans la vue et pouvoir afficher le calendrier
        $idEquipe = $req->get('id_equipe');
        
        //recuperer id evenement
        $id = $req->get('id');

        $em = $doctrine->getManager();
        $rep = $em->getRepository(Evenement::class);

        $evenement = $rep->find($id);

        $em->remove($evenement);
        $em->flush();

        return $this->redirectToRoute('calendrier', ['id_equipe' => $idEquipe]);
    }



    // modifier les présences pour ce jour

    #[Route('/presence/jour/update/{id_equipe}/{id}', name: 'presenceJour_update')]
    public function PresenceUpdate(Request $req, ManagerRegistry $doctrine)
    {
        
        $em = $doctrine->getManager();
        $idEquipe = $req->get('id_equipe');

        $id = $req->get('id');
        $rep = $em->getRepository(Evenement::class);

        $evenement = $rep->find($id);

        // obtenir le form rempli avec les infos de l'evenement sélectionné

        $formEvenement = $this->createForm(EvenementType::class, $evenement);
        $formEvenement->handleRequest($req);

        if ($formEvenement->isSubmitted()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('calendrier', ['id_equipe' => $idEquipe]);
        } else {
            return $this->render("presence_jour/update_presence_jour.html.twig" , ['formEvenement' => $formEvenement->createView()]);
        }
    }
}
