<?php
// src/Controller/LuckyController.php
namespace App\Controller; // namespace é o caminho do arquivo

use App\Entity\Filme;
use App\Repository\FilmeRepository;
use App\Repository\DiretorRepository;
use App\Repository\GeneroRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FilmeController extends AbstractController
{
    public function __construct( private FilmeRepository $filmeRepository, private DiretorRepository $diretorRepository, GeneroRepository $generoRepository ) { 

    }
    
    #[Route('/filme/lista', name: 'filme_list', methods: ['GET'])]
    public function filmes()
    {
        $listaFilmes = $this->filmeRepository->findAll(); // irá procurar toda a lista de filmes
        $listaDiretores = $this->diretorRepository->findAll(); // irá procurar toda a lista de diretores
        $listaGeneros = $this->diretorRepository->findAll(); // irá procurar toda a lista de generos

        return $this->render('filme/filmeList.html.twig', [
            'filmes' => $listaFilmes, // passando como parametro filmes a lista de filmes para ser usado no front
            'diretores' => $listaDiretores, // passando como parametro diretores a lista de diretores para ser usado no front
            'generos' => $listaGeneros // passando como parametro 'generos ' a lista de generos para ser usado no front
        ]);
    }

    #[Route('/filme/novo', name: 'filme_novo', methods: ['POST'])]
    public function novoFilme(Request $request)
    {
        $filme = new Filme(); // instanciando um objeto chamado $filme
        $filme->setName($request->request->get('filme')); //definindo o setName como o valor dentro do input filme em nosso front
        $diretor = $this->diretorRepository->find($request->request->get('diretor')); // a variavel diretor irá procurar no repositorio o diretor
        
        if($diretor){ // caso tenha diretor, ele irá setar o diretor e salvará o setName e setDiretor no repositorio, e depois dará um flush
            $filme->setDiretor($diretor);
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