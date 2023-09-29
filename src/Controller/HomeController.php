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

    #[Route('/vue1', name: 'vue1')]
    public function vue1(): Response
    {
        return $this->render('home/vue1.html.twig');
    }

    #[Route('/vue2', name: 'vue2')]
    public function vue2(): Response
    {
        return $this->render('home/vue2.html.twig');
    }


}
