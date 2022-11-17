<?php

namespace App\Controller;

use App\Entity\Critica;
use App\Repository\CriticaRepository;
use App\Repository\FilmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CriticaController extends AbstractController
{
    public function __construct ( private CriticaRepository $criticaRepository, private FilmeRepository $filmeRepository){

    }

    
    #[Route('/critica', name: 'app_critica', methods: ['GET'])]
    public function critica(): Response
    {
        $listaDiretores = $this->diretorRepository->findAll();
        return $this->render('critica/index.html.twig', [
            'controller_name' => 'CriticaController',
        ]);
    }

    #[Route('/critica/novo', name: 'novo_critica', methods: ['POST'])]
    public function novaCritica(Request $request)
    {
        $criticaTexto = $request->request->get('critica');
        $filmeId = $request->request->get('filme_id');
        $filme = $this->filmeRepository->find($filmeId);

        if($criticaTexto != null && $filme != null){
            $critica = new Critica();
            $critica->setCritica($criticaTexto);
            $critica->setFilme($filme);
            $this->criticaRepository->save($critica, true);
        }

        return $this->redirect('/filme/lista');
    }
}
