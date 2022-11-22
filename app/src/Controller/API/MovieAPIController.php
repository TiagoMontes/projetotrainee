<?php

namespace App\Controller\API;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FilmeAPIController extends AbstractController
{
    public function __construct( private MovieRepository $movieRepository)
    {

    }

    #[Route('/filme/api/find/{id}', methods: ['GET'])]
    public function find($id)
    {
        $movie = $this->movieRepository->find($id);

        return new JsonResponse($movie);
    }

    #[Route('/filme/api/findall', methods: ['GET'])]
    public function findAll()
    {
        $films = $this->movieRepository->findAll();

        return new JsonResponse($films);
    }

}