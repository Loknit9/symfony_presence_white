<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CalendrierController extends AbstractController
{
    #[Route('/calendrier/{date}/{equipe}', name: 'calendrier')]
    public function afficherCalendrier(SerializerInterface $serializer, Request $req): Response
    {

        // envoyer l'id de l'equipe
        $equipe = $req->getContent();
        
        // recuperer la date de l'evenement ds l'url
        $date = $req->getContent();
        
        $evenementsEquipes = $equipe->getEvenement();
        
        $evenementsJSON = $serializer->serialize($evenementsEquipes, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['evenement', 'equipe']]);
        $vars = ['evenementsJSON' => $evenementsJSON];

        return $this->render('calendrier/index.html.twig', $vars);
    }
}
