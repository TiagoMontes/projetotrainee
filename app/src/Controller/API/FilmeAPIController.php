<?php

namespace App\Controller\API;

use App\Repository\FilmeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FilmeAPIController extends AbstractController
{
    public function __construct( private FilmeRepository $filmeRepository)
    {

    }

    #[Route('/filme/api/find/{id}', methods: ['GET'])]
    public function find($id)
    {
        $filme = $this->filmeRepository->find($id);

        return new JsonResponse($filme);
    }

    #[Route('/filme/api/findall', methods: ['GET'])]
    public function findAll()
    {
        $filmes = $this->filmeRepository->findAll();

        return new JsonResponse($filmes);
    }




}