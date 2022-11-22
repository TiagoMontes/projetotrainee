<?php

namespace App\Controller\API;

use App\Repository\GenreRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GenreAPIController extends AbstractController
{
    public function __construct(private GenreRepository $genreRepository){

    }

    #[Route('/genero/api/findall', methods: ['GET'])]
    public function findAll(){

        $genre = $this->genreRepository->findAll();

        return new JsonResponse($genre);
    }

    #[Route('/genero/api/find/{id}', methods: ['GET'])]
    public function find(string $id){

        $genre = $this->genreRepository->find($id);

        return new JsonResponse($genre);
    }
}