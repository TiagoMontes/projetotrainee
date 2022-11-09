<?php

namespace App\Controller;

use App\Entity\Diretores;
use App\Repository\DiretoresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DiretorController extends AbstractController
{
    public function __construct( private DiretoresRepository $diretoresRepository) { // esse construtor será executado junto à uma instanciação da classe
    }

    #[Route('/diretor/lista', name: 'diretores_list', methods: ['GET'])] // rota é o caminho que o usuário acessa. O metodo GET é puxar informações
    public function diretores() // request é o objeto que contém os dados da requisição 
    {
        $listaDiretores = $this->diretoresRepository->findAll();

        return $this->render('diretor/index.html.twig', [ // renderiza a view number.html.twig
            'diretores' => $listaDiretores // pega todos os filmes do banco de dados
        ]);
    }

    #[Route('/diretor/novo', name: 'diretor_novo', methods: ['POST'])]
    public function novoDiretor(Request $request)
    {
        $diretores = new Diretores();
        $diretores->setNome($request->request->get('diretor'));
        $this->diretoresRepository->save($diretores, true);

        return $this->redirect('/diretor/lista');
    }
}
