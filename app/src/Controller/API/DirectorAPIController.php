<?php

namespace App\Controller\API;

use App\Repository\DirectorRepository; // importa a classe diretor repository para poder usar os metodos dela
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route; // annotation é uma forma de definir rotas no symfony (não é obrigatório)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DirectorAPIController extends AbstractController 
{
    public function __construct (private DirectorRepository $directorRepository){

    }

    #[Route('/director/api/findall', methods: ['GET'])]
    public function findAll() 
    {
        $director = $this->directorRepository->findAll();

        return new JsonResponse($director);
    }

    #[Route('/director/api/find/{id}', methods: ['GET'])]
    public function find(string $id) 
    {
        $director = $this->directorRepository->find($id);

        return new JsonResponse($director);
    }
}