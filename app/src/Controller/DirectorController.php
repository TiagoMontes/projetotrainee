<?php

namespace App\Controller;

use App\Entity\Director;
use App\Repository\DirectorRepository;
use App\Service\DirectorService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DiretorController extends AbstractController
{
    public function __construct( private DirectorRepository $directorRepository, private DirectorService $directorService) {
    }

    #[Route('/diretor/lista/{erro}', name: 'diretor_list', methods: ['GET'])]
    public function directors(string $erro = null)
    {
        $listDirectors = $this->directorRepository->findAll();
        
        return $this->render('diretor/index.html.twig', [
            'directors' => $listDirectors,
            'erro' => $erro
        ]);

    }

    #[Route('/diretor/novo', name: 'diretor_novo', methods: ['POST'])]
    public function novoDirector(Request $request)
    {
        $directorName = $request->request->get('diretor');
        $this->directorService->gerarDiretor($directorName);

        // ex de try catch
        // try {
        //     if($diretorName === "Tiago"){
        //         throw new \Exception("Tiago não pode ser diretor");     
        //     }
        // } catch (\Exception $e) {
        //     return $this->redirectToRoute('diretor_list', ["erro"=>$e->getMessage()]);
        // }
        return $this->redirect('/diretor/lista');
    }

    #[Route('/diretor/delete', name: 'diretor_delete', methods: ['POST'])] 
    public function deleteDirector(Request $request)
    {
        $diretorId = ($request->request->get('id'));  // Como ele sabe especificamente qual o id do input? sendo que estamos trazendo o name, não o value
        $diretor = $this->directorRepository->find($diretorId);
        if($diretor){
            $this->directorRepository->remove($director, true);
        }

        return $this->redirect('/diretor/lista');
    }

    #[Route('/diretor/editar', name: 'diretor_editar', methods: ['POST'])] 
    public function editDirector(Request $request)
    {
        $directorName = $request->request->get('diretor');
        $directorId = $request->request->get('id'); 

        try {
            if($directorName === "Tiago"){
                throw new \Exception("Tiago não pode ser diretor");     
            }
        } catch (\Exception $e) {
            return $this->redirectToRoute('diretor_list', ["erro"=>$e->getMessage()]);
        }
        
        $director = $this->directorRepository->find($directorId);
        $director->setName($directorName);

        if($directorName != null){
            $this->directorRepository->save($director, true);
        }

        return $this->redirect('/diretor/lista');
    }
}
