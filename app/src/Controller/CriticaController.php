<?php

namespace App\Controller;

use App\Entity\Critica;
use App\Repository\CriticaRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CriticaController extends AbstractController
{
    public function __construct ( private CriticaRepository $criticaRepository, private MovieRepository $movieRepository){

    }

    
    #[Route('/critica', name: 'app_critica', methods: ['GET'])]
    public function critica(): Response
    {
        $listaDiretores = $this->criticaRepository->findAll();
        return $this->render('critica/index.html.twig', [
            'controller_name' => 'CriticaController',
        ]);
    }

    #[Route('/critica/novo', name: 'novo_critica', methods: ['POST'])]
    public function novaCritica(Request $request)
    {
        $criticaTexto = $request->request->get('critica');
        $movieId = $request->request->get('filme_id');
        $movie = $this->movieRepository->find($movieId);

        if($criticaTexto != null && $movie != null){
            $critica = new Critica();
            $critica->setCritica($criticaTexto);
            $critica->setMovie($movie);
            $this->criticaRepository->save($critica, true);
        }

        return $this->redirect('/movie/list');
    }
}
