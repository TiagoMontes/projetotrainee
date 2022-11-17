<?php

namespace App\Controller\API;

use App\Repository\DiretorRepository; // importa a classe diretor repository para poder usar os metodos dela
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route; // annotation é uma forma de definir rotas no symfony (não é obrigatório)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DiretorAPIController extends AbstractController 
{
    public function __construct (private DiretorRepository $diretorRepository){

    }

    #[Route('/diretor/api/findall', methods: ['GET'])]
    public function findAll() 
    {
        $diretor = $this->diretorRepository->findAll();

        return new JsonResponse($diretor);
    }

    #[Route('/diretor/api/find/{id}', methods: ['GET'])]
    public function find(string $id) 
    {
        $diretor = $this->diretorRepository->find($id);

        return new JsonResponse($diretor);
    }
}