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
    public function __construct( private FilmeRepository $filmeRepository, private DiretorRepository $diretorRepository, private GeneroRepository $generoRepository ) { 

    }
    
    #[Route('/filme/lista', name: 'filme_list', methods: ['GET'])]
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

    #[Route('/filme/novo', name: 'filme_novo', methods: ['POST'])]
    public function novoFilme(Request $request)
    {
        // estamos pegando dados da request
        $filmeName = $request->request->get('filme');
        $diretorId = $request->request->get('diretor');
        $generoId = $request->request->get('diretor');
        
        // estamos procurando no banco dos repositorios
        $diretor = $this->diretorRepository->find($diretorId); // a variavel diretor irá procurar no repositorio o diretor
        $genero = $this->generoRepository->find($generoId);
        
        if($diretor && $genero){ // caso tenha diretor e genero, ele irá setar ambos e salvará o setDiretor e setGenero no repositorio, e depois dará um flush
            
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