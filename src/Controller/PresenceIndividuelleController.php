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
    #[Route('/presence/individuelle/{id_equipe}/{id_joueur}', name: 'presence_individuelle')]
    public function index(ManagerRegistry $doctrine, Request $req)
    {
        $em = $doctrine->getManager();

        // Récupérez l'equipe
        $id_equipe = $req->get('id_equipe');
        $equipe = $em->getRepository(Equipe::class)->find($id_equipe);

        $nomEquipe = $equipe->getNom();

        // Récupérez le joueur en fonction de l'ID dans l'URL
        $joueur = $em->getRepository(Personne::class)->find($req->get('id_joueur'));

        // initiale des états des présences
        $etats = ['P', 'A', 'E', 'B', 'R'];
        // Récupérez les présences du joueur
        $presences = $joueur->getPresences();

        // Initialisez un tableau pour stocker les présences par état
        $formattedPresences = [];

        // Initialisez un tableau pour stocker les dates distinctes
        $dates = [];

        // Bouclez sur les présences pour récupérer la date de l'événement
        foreach ($presences as $presence) {
            $formattedPresences[] = [
                'date' => $presence->getEvenement()->getStart(),
                'title' => $presence->getEvenement()->getTitle(),
                'etat' => $presence->getEtat(),
            ];

            // Ajoutez la date à $dates
            $dates[] = $presence->getEvenement()->getStart();
            $titles[] = $presence->getEvenement()->getTitle();
        }

        // Utilisez array_map pour convertir les objets DateTime en chaînes
        $dates = array_map(function ($date) {
            return $date->format('Y-m-d');
        }, $dates);

        // Supprimez les doublons de dates
        $dates = array_unique($dates);
        sort($dates);

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

        $vars = [
            'joueur' => $joueur,
            'nomEquipe' => $nomEquipe,
            'id_equipe' => $id_equipe,
            'presences' => $formattedPresences,
            'etats' => $etats,
            'dates' => $dates,
            'title' => $titles,
            'presenceEtat' => $presenceEtat,
        ];

        return $this->render('presence_individuelle/index.html.twig', $vars);
    }
}
