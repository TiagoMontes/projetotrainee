<?php
// src/Controller/LuckyController.php
namespace App\Controller; // namespace é o caminho do arquivo

use App\Entity\Filme;
use App\Repository\FilmeRepository;
use App\Repository\DiretorRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FilmeController extends AbstractController
{
    public function __construct( private FilmeRepository $filmeRepository, private DiretorRepository $diretorRepository ) { 

    }
    
    #[Route('/filme/lista', name: 'filme_list', methods: ['GET'])]
    public function filmes()
    {
        $listaFilmes = $this->filmeRepository->findAll();
        $listaDiretores = $this->diretorRepository->findAll();

        return $this->render('filme/filmeList.html.twig', [
            'filmes' => $listaFilmes,
            'diretores' => $listaDiretores
        ]);
    }

    #[Route('/filme/novo', name: 'filme_novo', methods: ['POST'])]
    public function novoFilme(Request $request)
    {
        $filme = new Filme();
        $filme->setName($request->request->get('filme'));
        $diretor = $this->diretorRepository->find($request->request->get('diretor'));
        
        if($diretor){
            $filme->setDiretor($diretor);
            $this->filmeRepository->save($filme, true);
        }
        
        return $this->redirect('/filme/lista');
    }
    
    #[Route('/filme/delete', name: 'filme_delete', methods: ['POST'])]
    public function deleteFilme(Request $request)
    {
        $filmeId = ($request->request->get('id'));
        $filme = $this->filmeRepository->find($filmeId);
        if($filme){
            $this->filmeRepository->remove($filme, true);
        }
        
        return $this->redirect('/filme/lista');
    }
    
}