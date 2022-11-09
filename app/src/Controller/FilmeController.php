<?php
// src/Controller/LuckyController.php
namespace App\Controller; // namespace é o caminho do arquivo

use App\Entity\Filme;
use App\Repository\FilmeRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FilmeController extends AbstractController
{
    public function __construct( private FilmeRepository $filmeRepository ) { // construtor é o trecho de código que é executado junto com a instanciação da classe
    }
    
    #[Route('/filme/lista', name: 'filme_list', methods: ['GET'])] // rota é o caminho que o usuário acessa. O metodo GET é puxar informações
    public function filmes() // request é o objeto que contém os dados da requisição 
    {
        $listaFilmes = $this->filmeRepository->findAll();

        return $this->render('lucky/number.html.twig', [ // renderiza a view number.html.twig
            'filmes' => $listaFilmes // pega todos os filmes do banco de dados
        ]);
    }

    #[Route('/filme/novo', name: 'filme_novo', methods: ['POST'])]
    public function novoFilme(Request $request)
    {
        $filme = new Filme();
        $filme->setName($request->request->get('filme')); // seta o nome do filme com o valor do input filme
        $this->filmeRepository->save($filme, true);// salva o filme

        return $this->redirect('/filme/lista');
    }  
    
    #[Route('/filme/delete', name: 'filme_delete', methods: ['POST'])]
    public function deleteFilme(Request $request)
    {
        $filmeId = ($request->request->get('id')); // recebendo ID do filme em especifico
        $filme = $this->filmeRepository->find($filmeId); // procurando id na lista de filmes
        if($filme){
            $this->filmeRepository->remove($filme, true);
        }
        
        return $this->redirect('/filme/lista');
    }
    
}