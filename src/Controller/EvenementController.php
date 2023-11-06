<?php

namespace App\Controller;

use DateTime;
use App\Entity\Equipe;
use App\Entity\Presence;
use App\Entity\Evenement;
use App\Form\PresenceType;
use App\Form\EvenementType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementController extends AbstractController
{
        // juste debug 
    #[Route('/affiche/form/presence', name: 'form_presence_test')]
    public function presenceTest ()
    {
        $form = $this->createForm(PresenceType::class);
        $vars = ['formPresence' => $form->createView()];
        
        return $this->render('evenement/affiche_form_presence.html.twig', $vars);
    }
    
    
    #[Route('/evenement/{date_evenement}/{id_equipe}', name: 'evenement')]
    public function evenement (ManagerRegistry $doctrine, Request $req)
    {      
        $em = $doctrine->getManager();
        
        // obtenir l'equipe qui correspond au paramètre nom
        $rep = $em->getRepository(Equipe::class);
        
        $equipe = $rep->find($req->get('id_equipe'));
        $id_equipe = $req->get('id_equipe');
        $date = $req->get('date_evenement');
                
        //obtenir la liste des joueurs de l'equipe
        $listeJoueurs = $equipe->getJoueurs();
        
        $evenement = new Evenement();
        
        // fixer ici les valeur de base de l'Evenement (couleur, etc...),
        // c.a.d. tout ce qu'on ne choisit pas dans le form
        $evenement->setStart(new DateTime($date));
        $evenement->setEnd(new DateTime($date));
        $evenement->setBackgroundColor("#ff0000");
        $evenement->setBorderColor("#ff0000");
        $evenement->setTextColor("#ffffff");
        // attention aux relations
        $evenement->setEquipe($equipe);
        
        $em->persist($evenement);
        // creer une Presence pour chaque Personne
        foreach ($equipe->getJoueurs() as $joueur){
            // au niveau de l'entite, pas du form
            $presence = new Presence();
            $presence->setJoueur($joueur); 
            $em->persist($presence);            
            $evenement->addPresence($presence);
            
        }
        
        // pour les presences on a besoin d'un formulaire
        // Chaque Presence dans le formulaire doit avoir une Personne
        $formEvenement = $this->createForm(EvenementType::class, $evenement);
        
        // $presence sera rempli lors du submit avec les données du formulaire 
        $formEvenement->handleRequest($req);
        
        // pour soumettre le form et stocker ds la bd
        if ($formEvenement->isSubmitted()) {  
            
            // dd ($formEvenement->getData());
            $em->flush();
            
            return $this->redirectToRoute("equipe_list", ['id_equipe' => $equipe->getId()]);
        }
        $vars = ['formEvenement' => $formEvenement->createView(), 'listeJoueurs' => $listeJoueurs, 'id_equipe' => $id_equipe];
        
        return $this->render('evenement/index.html.twig', $vars);
    }
}
    
    