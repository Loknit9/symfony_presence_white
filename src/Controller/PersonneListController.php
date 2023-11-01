<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonneListController extends AbstractController
{
    #[Route('/personne/list', name: 'personne_list')]
    public function personneListAll(ManagerRegistry $doctrine)

    {
        $repPersonnes = $doctrine->getRepository(Personne::class);
        $arrayObjetsPersonnes = $repPersonnes->findAll();

        $vars = ['arrayObjetsPersonnes' => $arrayObjetsPersonnes];
        return $this->render('personne_list/afficherListAll.html.twig', $vars);
    }
}
