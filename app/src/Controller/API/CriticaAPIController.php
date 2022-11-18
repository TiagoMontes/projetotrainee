<?php

namespace App\Controller\API;

use App\Repository\CriticaRepository; // importa a classe diretor repository para poder usar os metodos dela
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route; // annotation é uma forma de definir rotas no symfony (não é obrigatório)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CriticaAPIController extends AbstractController
{

    public function __construct( private CriticaRepository $criticaRepository)
    {

    }

    #[Route('/genero/api/findall', methods: ['GET'])]
    public function findAll(){

        $critica = $this->criticaRepository->findAll();

        return new JsonResponse($critica);
    }

    #[Route('/genero/api/findall', methods: ['GET'])]
    public function find($id){

        $critica = $this->criticaRepository->find($id);

        return new JsonResponse($critica);
    }

}