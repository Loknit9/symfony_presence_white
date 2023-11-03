<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulairePersonneAdminController extends AbstractController
{
    // ajouter un joueur ou un coach, afficher et traiter le formulaire//

    #[Route('/form/personne/admin', name: 'addForm_personne')]
    public function personneAdd(Request $req, ManagerRegistry $doctrine): Response
    {
        // créer une entité vide
        $personne = new Personne();

        // créer un objet formulaire et associer l'entité à cet objet formulaire

        $formPersonne = $this->createForm(PersonneType::class, $personne);

        // traiter la requête. Si on a fait un submit, l'entité $personne sera remplie
        // avec les données du form
        $formPersonne->handleRequest($req);

        // on vient d'un submit
        if ($formPersonne->isSubmitted()) {
            // formulaire soumis, stocker dans la BD

            $em = $doctrine->getManager();
            $em->persist($personne);
            $em->flush();

            // pour éviter une nouvelle insertion si on recharge la page, on va charger une autre action
            // redirectToRoute reçoit le nom d'une route
            return $this->redirectToRoute("personne_list");

        }
        return $this->render('form_personne_admin/addForm.html.twig', ['formPersonne' => $formPersonne->createView()]);
    }

    // obtenir un formulaire pré-rempli pour updater les infos d'un joueur ou un coach //


}
