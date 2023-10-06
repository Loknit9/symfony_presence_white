<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    //on autorise les users avec mot de passe à accéder à la page d'acceuil
    #[IsGranted('ROLE_USER')]
    #[Route ('/', name:'home')]
    public function home(){
        return $this->render ('home/index.html.twig');
    }
}





/* <?php

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
} */