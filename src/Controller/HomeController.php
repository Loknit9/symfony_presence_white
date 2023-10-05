<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{   

    // Afficher les equipes du coach connecté
    #[Route('/', name:'home')]
    public function afficherEquipesCoaches (SerializerInterface $serializer): Response
    {
        // lier le user qui est connecté à le personne (lié à l'equipe) qui coache
        $user = $this->getUser();
        $personne->getUser()->getEquipesCoaches();
        


        $equipesCoachJson = $serializer->serialize
        ($equipesCoach,'json', [AbstractNormalizer::IGNORED_ATTRIBUTES=>['user', 'personne']]); // on exclut les liens vers cette classe pour eviter le traitement circulaire

        dd($equipesCoachJson);

        return $this->render('home/index.html.twig');
    }
}
