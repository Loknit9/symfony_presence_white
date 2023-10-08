<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipeListController extends AbstractController
{
    #[Route('/equipe/list', name: 'app_equipe_list')]
    public function index(): Response
    {
        return $this->render('equipe_list/index.html.twig');
    }
}
