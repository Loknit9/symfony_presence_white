<?php

namespace App\Controller;

use App\Form\PersonneType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulairePersonneAdminController extends AbstractController
{
    #[Route('/form/personne/admin', name: 'form_personne')]
    public function index(): Response
    {
        $formPersonne = $this->createForm(PersonneType::class);

        $vars = ['formPersonne' => $formPersonne->createView()];

        return $this->render('form_personne_admin/form.html.twig', $vars );
    }
}


// obtenir un formulaire pré-rempli pour updater un joueur ou un coach //

