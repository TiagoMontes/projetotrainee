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
    public function __construct( private DiretorRepository $diretorRepository) {
    }

    #[Route('/diretor/lista/{erro}', name: 'diretor_list', methods: ['GET'])]
    public function diretores(string $erro = null)
    {
        $listaDiretores = $this->diretorRepository->findAll();
        
        return $this->render('diretor/index.html.twig', [
            'diretores' => $listaDiretores,
            'erro' => $erro
        ]);

    }

    #[Route('/diretor/novo', name: 'diretor_novo', methods: ['POST'])]
    public function novoDiretor(Request $request)
    {
        $diretorName = $request->request->get('diretor');

        try {
            if($diretorName === "Tiago"){
                throw new \Exception("Tiago não pode ser diretor");     
            }
        } catch (\Exception $e) {
            return $this->redirectToRoute('diretor_list', ["erro"=>$e->getMessage()]);
        }

        $diretor = new Diretor();
        $diretor->setName($diretorName);
        $this->diretorRepository->save($diretor, true);

        return $this->redirect('/diretor/lista');
    }

    #[Route('/diretor/delete', name: 'diretor_delete', methods: ['POST'])] 
    public function deleteDiretor(Request $request)
    {
        $diretorId = ($request->request->get('id'));  // Como ele sabe especificamente qual o id do input? sendo que estamos trazendo o name, não o value
        $diretor = $this->diretorRepository->find($diretorId);
        if($diretor){
            $this->diretorRepository->remove($diretor, true);
        }

        return $this->redirect('/diretor/lista');
    }

    #[Route('/diretor/editar', name: 'diretor_editar', methods: ['POST'])] 
    public function editarDiretor(Request $request)
    {
        $diretorName = $request->request->get('diretor');


        $diretorId = ($request->request->get('id')); 
        $diretor = $this->diretorRepository->find($diretorId);
        $diretor->setName($diretorName);

        if($diretor){
            $this->diretorRepository->save($diretor, true);
        }

        return $this->redirect('/diretor/lista');
    }
}
