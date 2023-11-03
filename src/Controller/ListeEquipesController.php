<?php

namespace App\Controller;

use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeEquipesController extends AbstractController
{
    #[Route('/liste/equipe', name: 'liste_equipes')]
    public function listeEquipes(ManagerRegistry $doctrine)

    {
        $repEquipes = $doctrine->getRepository(Equipe::class);
        $arrayObjetsEquipes = $repEquipes->findAll();

        $equipesWithDetails = [];
        foreach ($arrayObjetsEquipes as $equipe) {
            $equipesWithDetails[] = [
                'nom' => $equipe->getNom(),
                'numeroEquipe' => $equipe->getNumeroEquipe(),
                'categorieGenre' => $equipe->getCategorieGenre(),
                'id_Equipe' => $equipe->getId(),
            ];
        }

        $vars = ['equipesWithDetails' => $equipesWithDetails];

        return $this->render('liste_equipes/index.html.twig', $vars);
    }
}
