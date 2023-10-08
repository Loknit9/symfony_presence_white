<?php

namespace App\Controller;


use App\Entity\Equipe;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route("/gestion/home_admin", name:"home_admin")]
    public function homeadmin()
    {   
        $admin = $this->getDoctrine()->getManager();
        $equipes = $admin->getRepository(Equipe::class)->findAll();

        return $this->render('gestion/home_admin.html.twig', [
            'equipes'=> $equipes,
        ]);
    }

    #[IsGranted('ROLE_COACH')]
    #[Route("/gestion/home_coach", name:"home_coach")]
    public function homecoach()
    {

        return $this->render('gestion/home_coach.html.twig');
    }



  // {
    //     $user = $this->getUser(); // Récupérer l'utilisateur actuel

    //     $personne = $user->getPerson();

    //     $equipesCoaches = $personne->getEquipesCoaches();

    //     return $this->render('gestion/home_coach.html.twig', [
    //         'equipesCoaches' => $equipesCoaches,
    //     ]);
    // }

}
