<?php
// src/Controller/LuckyController.php

namespace App\Controller; // namespace é o caminho do arquivo

use App\Entity\Filme;
use App\Repository\FilmeRepository;
use App\Repository\CriticaRepository;
use App\Repository\DiretorRepository; // importa a classe diretor repository para poder usar os metodos dela
use App\Repository\GeneroRepository; // importa a classe genero repository para poder usar os metodos dela
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // annotation é uma forma de definir rotas no symfony (não é obrigatório)
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

// a classe abaixo é um controller, que é uma metodo que recebe uma requisição e retorna uma resposta
class FilmeController extends AbstractController  
{
    public function __construct( private FilmeRepository $filmeRepository, private DiretorRepository $diretorRepository, private GeneroRepository $generoRepository, private CriticaRepository $criticaRepository) { 
        // o construtor é um metodo que é executado quando a classe é instanciada. 
    }
    
    #[Route('/filme/lista', name: 'filme_list', methods: ['GET'])] // route é a rota que o usuario vai acessar para acessar o metodo. Ela mapeia uma url para podermos ver o resultado do metodo
    public function filmes()
    {
        $listaFilmes = $this->filmeRepository->findAll(); // irá procurar toda a lista de filmes
        $listaDiretores = $this->diretorRepository->findAll(); // irá procurar toda a lista de diretores
        $listaGeneros = $this->generoRepository->findAll(); // irá procurar toda a lista de generos

        return $this->render('filme/filmeList.html.twig', [
            'filmes' => $listaFilmes, 
            'diretores' => $listaDiretores, 
            'generos' => $listaGeneros,
        ]);
    }

    // Request é um objeto que contém a requisição feita pelo usuario
    #[Route('/filme/novo', name: 'filme_novo', methods: ['POST'])]
    public function novoFilme(Request $request) 
    {

        // estamos pegando dados da request, poderiamos resolver com formType
        $filmeName = $request->request->get('filme');
        $diretorId = $request->request->get('diretor'); // para trazermos o value do select, precisamos passar o name do select
        $generoId = $request->request->get('generoId');
        
        $diretor = $this->diretorRepository->find($diretorId); // irá procurar o diretor pelo id, que foi passado na request acima atraves do input diretor.
        $genero = $this->generoRepository->find($generoId); 
        
        if($diretor != null && $genero != null && $filmeName != null ){
            
            $filme = new Filme(); // instanciando um objeto chamado $filme
            $filme->setName($filmeName); //definindo o setName como o valor dentro do input filme em nosso front
            $filme->setDiretor($diretor);
            $filme->setGenero($genero);

            $this->filmeRepository->save($filme, true);
        }
        
        return $this->redirect('/filme/lista'); // redirecionará para a lista de filmes
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