<?php

namespace App\Controller;

use App\Entity\Director;
use App\Repository\DirectorRepository;
use App\Service\DirectorService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DirectorController extends AbstractController
{
    public function __construct( private DirectorRepository $directorRepository, private DirectorService $directorService) {
    }

    #[Route('/director/list/{erro}', name: 'director_list', methods: ['GET'])]
    public function directors(string $erro = null)
    {
        $listDirectors = $this->directorRepository->findAll();
        
        return $this->render('director/index.html.twig', [
            'directors' => $listDirectors,
            'erro' => $erro
        ]);

    }

    #[Route('/director/new', name: 'director_new', methods: ['POST'])]
    public function novoDirector(Request $request)
    {
        $directorName = $request->request->get('director');
        $this->directorService->generateDirector($directorName);

        // ex de try catch
        // try {
        //     if($diretorName === "Tiago"){
        //         throw new \Exception("Tiago não pode ser diretor");     
        //     }
        // } catch (\Exception $e) {
        //     return $this->redirectToRoute('diretor_list', ["erro"=>$e->getMessage()]);
        // }
        return $this->redirect('/director/list');
    }

    #[Route('/director/delete', name: 'director_delete', methods: ['POST'])] 
    public function deleteDirector(Request $request)
    {
        $directorId = ($request->request->get('id'));  // Como ele sabe especificamente qual o id do input? sendo que estamos trazendo o name, não o value
        $director = $this->directorRepository->find($directorId);
        if($director){
            $this->directorRepository->remove($director, true);
        }

        return $this->redirect('/director/list');
    }

    #[Route('/director/edit', name: 'director_edit', methods: ['POST'])] 
    public function editDirector(Request $request)
    {
        $directorName = $request->request->get('director');
        $directorId = $request->request->get('id'); 

        // try {
        //     if($directorName === "Tiago"){
        //         throw new \Exception("Tiago não pode ser diretor");     
        //     }
        // } catch (\Exception $e) {
        //     return $this->redirectToRoute('director_list', ["erro"=>$e->getMessage()]);
        // }
        
        $director = $this->directorRepository->find($directorId);
        $director->setName($directorName);


        if($directorName != null){
            $this->directorRepository->save($director, true);
        }

        return $this->redirect('/director/list');
    }
}
