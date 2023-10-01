<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/presence', name: 'presence')]
    public function vue1(): Response
    {
        return $this->render('home/presence.html.twig');
    }

    #[Route('/message', name: 'message')]
    public function vue2(): Response
    {
        return $this->render('home/message.html.twig');
    }


}
