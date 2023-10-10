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

        // obtenir l'id de l'equipe et la date selectionnee ds l'url
        $dateSelect = $req->get("date");
        $equipeSelect = $req->get("equipe");
        
        //Obtenir tous les événements de l'équipe à la date choisie.
        $evenements = $this->getEvenementsEquipeDateSelect($equipeSelect, $dateSelect);

        //dd($evenementsEquipe[0]);
        
        $evenementsJSON = $serializer->serialize($evenements, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['evenement', 'equipe']]);
        $vars = ['evenementsJSON' => $evenementsJSON];

        return $this->render('calendrier/index.html.twig', $vars);
    }
}
