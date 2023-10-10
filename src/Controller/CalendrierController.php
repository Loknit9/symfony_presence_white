<?php

namespace App\Controller;

use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CalendrierController extends AbstractController
{
    #[Route('/calendrier/{id_equipe}', name: 'calendrier')]
    public function afficherCalendrier(SerializerInterface $serializer, Request $req, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        // obtenir l'equipe qui correspond au paramètre nom
        $rep = $em->getRepository(Equipe::class);

        // obtenir l'id de l'equipe 
        $equipeSelect = $rep ->find($req->get("id_equipe"));
        
        //Obtenir tous les événements de l'équipe
        $evenementsEquipe = $equipeSelect->getEvenement();
        
        //serialiser l'array en objet pour etre envoyé au calendrier

        $evenementsJSON = $serializer->serialize($evenementsEquipe, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['presences', 'equipes']]);

        $vars = ['evenementsJSON' => $evenementsJSON];

        return $this->render('calendrier/index.html.twig', $vars);
    }
}
