<?php
// src/Controller/LuckyController.php

namespace App\Controller; // namespace é o caminho do arquivo

use App\Entity\Movie;
use App\Service\MovieService;
use App\Repository\MovieRepository;
use App\Repository\CriticaRepository;
use App\Repository\DiretorRepository; // importa a classe diretor repository para poder usar os metodos dela
use App\Repository\GeneroRepository; // importa a classe genero repository para poder usar os metodos dela
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // annotation é uma forma de definir rotas no symfony (não é obrigatório)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

// a classe abaixo é um controller, que é uma metodo que recebe uma requisição e retorna uma resposta
class MovieController extends AbstractController  
{
    public function __construct( private MovieRepository $movieRepository, private DiretorRepository $diretorRepository, private GeneroRepository $generoRepository, private CriticaRepository $criticaRepository, private MovieService $movieService) { 
        // o construtor é um metodo que é executado quando a classe é instanciada. 
    }
    
    #[Route('/filme/lista', name: 'filme_list', methods: ['GET'])] // route é a rota que o usuario vai acessar para acessar o metodo. Ela mapeia uma url para podermos ver o resultado do metodo
    public function filmes()
    {
        $listaFilmes = $this->movieRepository->findAll(); // irá procurar toda a lista de filmes
        $listaDiretores = $this->diretorRepository->findAll(); // irá procurar toda a lista de diretores
        $listaGeneros = $this->generoRepository->findAll(); // irá procurar toda a lista de generos

        return $this->render('filme/filmeList.html.twig', [
            'films' => $listaFilmes, 
            'diretores' => $listaDiretores, 
            'generos' => $listaGeneros,
        ]);
    }

    // Request é um objeto que contém a requisição feita pelo usuario
    #[Route('/filme/novo', name: 'filme_novo', methods: ['POST'])]
    public function novoFilme(Request $request) 
    {
        $name = $request->request->get('movie');
        $diretorId = $request->request->get('diretorId');
        $generoId = $request->request->get('generoId');
        
        $this->movieService->gerarFilme($name, $diretorId, $generoId);
        
        return $this->redirect('/filme/lista');
    }
    
    #[Route('/filme/delete', name: 'filme_delete', methods: ['POST'])]
    public function deleteFilme(Request $request)
    {
        $movieId = ($request->request->get('id'));
        $movie = $this->movieRepository->find($movieId);
        
        if($movie){
            $this->movieRepository->remove($movie, true);
        }
        
        return $this->redirect('/filme/lista');
    }
}