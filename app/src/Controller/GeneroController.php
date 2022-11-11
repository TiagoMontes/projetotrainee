<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Repository\GeneroRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GeneroController extends AbstractController
{
    public function __construct( private GeneroRepository $generoRepository) {
    }

    #[Route('/genero/lista', name: 'genero_list', methods: ['GET'])]
    public function generos()
    {
        $listaGeneros = $this->generoRepository->findAll();

        return $this->render('genero/index.html.twig', [
            'generos' => $listaGeneros
        ]);
    }

    #[Route('/genero/novo', name: 'genero_novo', methods: ['POST'])]
    public function novoGenero(Request $request)
    {
        $genero = new Genero();
        $genero->setTitulo($request->request->get('genero'));
        $this->generoRepository->save($genero, true);

        return $this->redirect('/genero/lista');
    }

    #[Route('/genero/delete', name: 'genero_delete', methods: ['POST'])] 
    public function deleteGenero(Request $request)
    {
        $generoId = ($request->request->get('id'));
        $genero = $this->generoRepository->find($generoId);
        if($genero){
            $this->generoRepository->remove($genero, true);
        }

        return $this->redirect('/genero/lista');
    }
}
