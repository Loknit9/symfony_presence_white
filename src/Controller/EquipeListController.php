<?php

namespace App\Controller;

use App\Entity\Equipe;
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
        $rep = $em->getRepository(Equipe::class)->findOneBy([
            'categorieAge' => $categorieAge,
            'categorieGenre'=> $categorieGenre,
            'nom' => $nom,
        ]);

        $listeJoueurs = $rep->getJoueurs();

        $vars = ['listeJoueurs' => $listeJoueurs];

        return $this->render('equipe_list/index.html.twig', $vars);
    }
}
