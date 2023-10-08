<?php

namespace App\Controller;


use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionController extends AbstractController
{
    //route pour arriversur la page admin après le login d'un admin
    #[IsGranted('ROLE_ADMIN')]
    #[Route("/gestion/home_admin", name:"home_admin")]
    public function homeadmin(ManagerRegistry $doctrine)
    {   
        $em = $doctrine->getManager();
    
        $rep = $em->getRepository(Equipe::class);
        
        //obtenir toutes les equipes
        $equipes = $rep->findAll();
        $vars = ['equipes'=> $equipes];

        return $this->render('gestion/home_admin.html.twig', $vars);
    }

   //route pour arriver sur la page du coach qui c'est loggué.

    #[IsGranted('ROLE_COACH')]
    #[Route("/gestion/home_coach", name:"home_coach")]
    public function homecoach()
    {

        return $this->render('gestion/home_coach.html.twig');
    }



  // {     
           //obtenir le user actuel  
    //     $user = $this->getUser(); 

    //     $personne = $user->getPerson();

           //obtenir la personne qui coach l'equipe 
    //     $equipesCoaches = $personne->getEquipesCoaches();
    //     $vars = [equipesCoaches' => $equipesCoaches]

    //     return $this->render('gestion/home_coach.html.twig', $vars);
    // }

}
