<?php

namespace App\Controller\API;

use App\Repository\CriticaRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CriticaAPIController extends AbstractController
{

    public function __construct( private CriticaRepository $criticaRepository)
    {

    }

    #[Route('/critica/api/findall', methods: ['GET'])]
    public function findAll(){

        $critica = $this->criticaRepository->findAll();

        return new JsonResponse($critica);
    }

    #[Route('/critica/api/find/{id}', methods: ['GET'])]
    public function find($id){

        $critica = $this->criticaRepository->find($id);

        return new JsonResponse($critica);
    }

}