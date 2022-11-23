<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends AbstractController
{
    public function __construct ( private ReviewRepository $reviewRepository, private MovieRepository $movieRepository){

    }

    
    #[Route('/review', name: 'app_review', methods: ['GET'])]
    public function review(): Response
    {
        $listaDiretores = $this->criticaRepository->findAll();
        return $this->render('review/index.html.twig', [
            'controller_name' => 'ReviewController',
        ]);
    }

    #[Route('/review/new', name: 'new_review', methods: ['POST'])]
    public function newReview(Request $request)
    {
        $reviewContent = $request->request->get('review');
        $movieId = $request->request->get('movie_id');
        $movie = $this->movieRepository->find($movieId);

        if($reviewContent != null && $movie != null){
            $review = new Review();
            $review->setReview($reviewContent);
            $review->setMovie($movie);
            $this->reviewRepository->save($review, true);
        }

        return $this->redirect('/movie/list');
    }
}
