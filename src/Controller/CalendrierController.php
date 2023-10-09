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
    public function afficherCalendrier(SerializerInterface $serializer, Request $req, $date, $equipe): Response
    {

        // obtenir l'id de l'equipe
        $equipe = $req->getContent();
        
        // recuperer la date de l'evenement ds l'url
        $date = $req->getContent();
        
        $evenementsEquipe = $this->getEvenement($equipe, $date);

        //dd($evenementsEquipe[0]);
        
        $evenementsJSON = $serializer->serialize($evenementsEquipe, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['evenement', 'equipe']]);
        $vars = ['evenementsJSON' => $evenementsJSON];

        return $this->render('calendrier/index.html.twig', $vars);
    }
}
