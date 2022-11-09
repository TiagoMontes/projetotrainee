<?php

namespace App\Controller;

use App\Entity\Diretor;
use App\Repository\DiretorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DiretorController extends AbstractController
{
    public function __construct( private DiretorRepository $diretorRepository) { // esse construtor será executado junto à uma instanciação da classe
    }

    #[Route('/diretor/lista', name: 'diretor_list', methods: ['GET'])] // rota é o caminho que o usuário acessa. O metodo GET é puxar informações
    public function diretores() // request é o objeto que contém os dados da requisição 
    {
        $listaDiretores = $this->diretorRepository->findAll();

        return $this->render('diretor/index.html.twig', [ // renderiza a view number.html.twig
            'diretores' => $listaDiretores // pega todos os filmes do banco de dados
        ]);
    }

    #[Route('/diretor/novo', name: 'diretor_novo', methods: ['POST'])]
    public function novoDiretor(Request $request)
    {
        $diretor = new Diretor();
        $diretor->setName($request->request->get('diretor'));
        $this->diretorRepository->save($diretor, true);

        return $this->redirect('/diretor/lista');
    }

    #[Route('/diretor/delete', name: 'diretor_delete', methods: ['POST'])] 
    public function deleteDiretor(Request $request)
    {
        $diretorId = ($request->request->get('id'));
        $diretor = $this->diretorRepository->find($diretorId);
        if($diretor){
            $this->diretorRepository->remove($diretor, true);
        }

        return $this->redirect('/diretor/lista');
    }
}
