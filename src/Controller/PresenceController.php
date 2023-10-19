<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Presence;
use App\Form\PresenceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresenceController extends AbstractController
{
    //Pour afficher le formulaire de présence
    #[Route('/presence/{date}/{id_equipe}', name: 'presence')]
    public function presence (Presence $presence, ManagerRegistry $doctrine, Request $req)
    {
        $em = $doctrine->getManager();

        // obtenir l'equipe qui correspond au paramètre nom
        $rep = $em->getRepository(Equipe::class);

        $equipe = $rep->find($req->get('id_equipe'));

        //obtenir la liste des joueurs de l'equipe
        $listeJoueurs = $equipe->getJoueurs();

        //creer une instance presence
        //$presence = new Presence();

        // pour créer le formulaire
        $formPresence = $this->createForm(PresenceType::class, $presence);

        // $presence sera rempli lors du submit avec les données du formulaire 
        $formPresence->handleRequest($req);

        // pour soumettre le form et stocker ds la bd
        if ($formPresence->isSubmitted()) {  

            $em->flush();

            //rediriger vers la liste des joueurs avec toutes les présences depuis le début de l'année
            return $this->redirectToRoute("equipe_list");
        }
        // afficher ds la vue le formulaire et le liste des joueurs
        $vars = ['formPresence' => $formPresence->createView(), 'listeJoueurs' => $listeJoueurs, 'equipe' => $equipe];

        return $this->render('presence/index.html.twig', $vars);

    }
}
