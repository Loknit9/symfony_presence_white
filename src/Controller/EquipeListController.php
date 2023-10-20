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

        $query = $entityManager->createQuery('
            SELECT j.nom AS joueur, p.etat, COUNT(p.id) AS nombrePresences
            FROM App\Entity\Equipe e
            JOIN e.joueurs j
            LEFT JOIN j.presences p
            WHERE e.id = :equipeId
            GROUP BY j.id, p.etat
        ');

        $query->setParameter('equipeId', $id);

        $recapPresencesJoueurs = $query->getResult();

        // afficher ds la vue la liste des joueurs
        $vars = ['listJoueurs' => $listJoueurs,'nomEquipe' => $nomEquipe, 'recapPresencesJoueurs'=> $recapPresencesJoueurs ];

        return $this->render('equipe_list/index.html.twig', $vars);
    }
}
