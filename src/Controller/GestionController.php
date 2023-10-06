<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionController extends AbstractController
{
    #[Route('/gestion/action1')]
    public function action1()
    {
        return $this->render('gestion/action1.html.twig');
    }

    #[Route('/home/presence')]
    public function presence()
    {
        return $this->render('gestion/presence.html.twig');
    }
}
