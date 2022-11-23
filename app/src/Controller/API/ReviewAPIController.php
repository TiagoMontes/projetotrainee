<?php

namespace App\Controller\API;

use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReviewAPIController extends AbstractController
{

    public function __construct( private ReviewRepository $reviewRepository)
    {

    }

    #[Route('/review/api/findall', methods: ['GET'])]
    public function findAll(){

        $reviews = $this->reviewRepository->findAll();

        return new JsonResponse($reviews);
    }

    #[Route('/review/api/find/{id}', methods: ['GET'])]
    public function find($id){

        $review = $this->reviewRepository->find($id);

        return new JsonResponse($review);
    }

}