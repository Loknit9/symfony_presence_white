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

    $personnesWithDetails = [];
    foreach ($arrayObjetsPersonnes as $personne) {
        $personnesWithDetails[] = [
            'prenom' => $personne->getPrenom(),
            'nom' => $personne->getNom(),
            'contact1' => $personne->getContact1(), 
            'contact2' => $personne->getContact2(),
            'dateNaissance' => $personne->getDateNaissance(),
            'equipesCoach' => $personne->getEquipesCoaches(),
            'equipesJoueur' => $personne->getEquipesJoueur(),
            'id_Joueur' => $personne->getId(),
        ];
    }

    $vars = ['personnesWithDetails' => $personnesWithDetails];
    return $this->render('personne_list/afficherListAll.html.twig', $vars);
    }
}
