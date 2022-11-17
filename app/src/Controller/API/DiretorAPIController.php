<?php

namespace App\Controller\API;

use App\Repository\DiretorRepository; // importa a classe diretor repository para poder usar os metodos dela
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // annotation é uma forma de definir rotas no symfony (não é obrigatório)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DiretorAPIController extends AbstractController 
{

    #[Route('/diretor/api/teste', methods: ['POST'])]
    public function testeAPI() 
    {
        
    }
}