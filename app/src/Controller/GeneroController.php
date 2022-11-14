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
        $generoName = $request->request->get('genero');


        if($generoName != null){
            $genero = new Genero();
            $genero->setTitulo($generoName);
            $this->generoRepository->save($genero, true);
        }

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

    #[Route('/genero/editar', name: 'genero_editar', methods: ['POST'])]
    public function editarGenero(Request $request)
    {

        $generoName = $request->request->get('genero'); //Estamos fazendo uma requisição para PEGAR 'genero' do front-end
        $generoId = $request->request->get('id'); // Estamos requisitando o Id

        $genero = $this->generoRepository->find($generoId); // vamos procurar o id no nosso banco de dados
        $genero->setTitulo($generoName);// Após identificarmos o ID, definiremos o setTitulo sendo o nome puxando em $generoName pelo input

        if($generoName != null){
            $this->generoRepository->save($genero, true);
        }

        return $this->redirect('/genero/lista');

    }
}
