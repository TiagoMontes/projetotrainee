<?php

namespace App\Controller\API;

use App\Repository\GeneroRepository; // importa a classe diretor repository para poder usar os metodos dela
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route; // annotation é uma forma de definir rotas no symfony (não é obrigatório)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GeneroAPIController extends AbstractController
{
    public function __construct(private GeneroRepository $generoRepository){

    }

    #[Route('/genero/api/findall', methods: ['GET'])]
    public function findAll(){

        $genero = $this->generoRepository->findAll();

        return new JsonResponse($genero);
    }

    #[Route('/genero/api/find/{id}', methods: ['GET'])]
    public function find(string $id){

        $genero = $this->generoRepository->find($id);

        return new JsonResponse($genero);
    }
}