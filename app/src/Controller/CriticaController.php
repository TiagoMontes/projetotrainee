<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CriticaController extends AbstractController
{
    #[Route('/critica', name: 'app_critica')]
    public function index(): Response
    {
        return $this->render('critica/index.html.twig', [
            'controller_name' => 'CriticaController',
        ]);
    }
}
