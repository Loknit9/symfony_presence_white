<?php

namespace App\Controller;

use DateTime;
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

        // arranger les noms des proprietes
        $evenementsJSON = str_replace ("backgroundColor", "background_color",$evenementsJSON);
        $evenementsJSON = str_replace ("textColor", "text_color",$evenementsJSON);
        $evenementsJSON = str_replace ("borderColor", "border_color",$evenementsJSON);

        // id equipe pour envoyer l'id de l'equipe ds la vue
        $vars = ['evenementsJSON' => $evenementsJSON, 'id_equipe' => $equipeSelect->getId(), 'nom_equipe' => $equipeSelect->getNom(),];

        return $this->render('calendrier/index.html.twig', $vars);
    }

    #[Route ('/afficher/liste/equipes/{date}/{id_equipe}')]
    public function afficheListeEquipes (Request $req){
        $date = $req->get('date');
        $id_equipe = $req->get('id');

        dd (new DateTime($date));
    }
}
