<?php

namespace App\Controller;
use App\Entity\Equipe;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EquipeListController extends AbstractController
{   
    #[Route('/equipe/list/{id}', name: 'equipe_list')]
    public function listjoueurs(ManagerRegistry $doctrine, Request $req, EntityManagerInterface $entityManager,)
    {
        $em = $doctrine->getManager();

        $em = $entityManager;
        $id = $req->get('id');

        $equipe = $em->getRepository(Equipe::class)->find($id);;

        $nomEquipe = $equipe->getNom();
        $listJoueurs = $equipe->getJoueurs();

        $joueurs = $equipe->getJoueurs();
        $etats = ['P', 'A', 'E', 'B', 'R']; 

        $result = [];

        foreach ($joueurs as $joueur) {
            $joueurNom = $joueur->getPrenom() . ' ' . $joueur->getNom();

            $presenceCount = [];

            foreach ($etats as $etat) {
                // Comptez le nombre de présences par état pour ce joueur
                $count = 0;
                foreach ($joueur->getPresences() as $presence) {
                    if ($presence->getEtat() === $etat) {
                        $count++;
                    }
                }

                $presenceCount[$etat] = $count;
            }

            $result[$joueurNom] = $presenceCount;
        }
;

        // afficher ds la vue la liste des joueurs
        $vars = ['listJoueurs' => $listJoueurs,'nomEquipe' => $nomEquipe, 'etats' => $etats,'result' => $result, ];

        return $this->render('equipe_list/index.html.twig', $vars);
    }
}
