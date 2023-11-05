<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FormEquipeAdminController extends AbstractController
{
    #[Route('/form/equipe/admin', name: 'form_equipe_admin')]
    public function addEquipe(ManagerRegistry $doctrine, Request $req): Response
    {
        // créer une entité vide
        $equipe = new Equipe();

        // créer un objet formulaire et associer l'entité à cet objet formulaire

        $formEquipe = $this->createForm(EquipeType::class, $equipe);

        // traiter la requête. Si on a fait un submit, l'entité $equipe sera remplie
        // avec les données du form
        $formEquipe->handleRequest($req);

        // on vient d'un submit
        if ($formEquipe->isSubmitted()) {
            // formulaire soumis, stocker dans la BD

            $em = $doctrine->getManager();
            $em->persist($equipe);
            $em->flush();

            // pour éviter une nouvelle insertion si on recharge la page, on va charger une autre action
            // redirectToRoute reçoit le nom d'une route
            return $this->redirectToRoute("liste_equipes");
        }

        return $this->render('form_equipe_admin/addequipe.html.twig', ['formEquipe' => $formEquipe->createView()]);
    }


    // afficher détail d'une equipe

    #[Route('/equipe/infos/{id}', name: 'equipe_infos')]
    public function equipeInfos(Request $req, ManagerRegistry $doctrine)
    {
        $id = $req->get('id');

        $em = $doctrine->getManager();
        $rep = $em->getRepository(Equipe::class);

        $equipe = $rep->find($id);

        $vars = ['equipe' => $equipe];
        return $this->render('form_equipe_admin/equipe_infos.html.twig', $vars);
    }


    // delete Livre
    #[Route('/equipe/delete/{id}', name: 'equipe_delete')]
    public function livreDelete(Request $req, ManagerRegistry $doctrine)
    {

        $id = $req->get('id');

        $em = $doctrine->getManager();
        $rep = $em->getRepository(Equipe::class);

        $equipe = $rep->find($id);

        $em->remove($equipe);
        $em->flush();

        return $this->redirectToRoute('liste_equipes');
    }

    // modifier une equipe

    #[Route('/equipe/update/{id}', name: 'equipe_update')]
    public function EquipeUpdate(Request $req, ManagerRegistry $doctrine)
    {
        $id = $req->get('id');

        $em = $doctrine->getManager();
        $rep = $em->getRepository(Equipe::class);

        $equipe = $rep->find($id);

        // obtenir le form rempli avec les infos de l'equipe sélectionnée

        $formEquipe = $this->createForm(EquipeType::class, $equipe);
        $formEquipe->handleRequest($req);

        if ($formEquipe->isSubmitted()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("liste_equipes");
        } else {
            return $this->render("form_equipe_admin/updateequipe.html.twig" , ['formEquipe' => $formEquipe->createView()]);
        }
    }
}
