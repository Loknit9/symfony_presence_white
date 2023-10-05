<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
        
        #[Route('/', name: 'home')]
        
        public function homeCoach(){
        // Recupérez le user
        $user = $this->getUser();

        // Récupérez les équipes dont l'utilisateur est le coach
        $equipes = $user-> getPerson()->getEquipesCoaches();

        return $this->render('home/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }
}