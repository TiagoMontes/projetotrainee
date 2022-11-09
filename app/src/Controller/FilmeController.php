<?php
// src/Controller/LuckyController.php
namespace App\Controller; // namespace é o caminho do arquivo

use App\Entity\Filme;
use App\Repository\FilmeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FilmeController extends AbstractController
{
    public function __construct( private FilmeRepository $filmeRepository ) { // construtor é o trecho de código que é executado junto com a instanciação da classe
    }
    
    #[Route('/filme', name: 'filme_list', methods: ['GET','POST'])] // rota é o caminho que o usuário acessa. O metodo GET é padrão, e post é quando o usuário envia dados
    public function filmes(Request $request): Response // request é o objeto que contém os dados da requisição 
    {

        if($request->request->all()){ // all() significa que ele vai pegar todos os dados da requisição e jogar no array
            $filme = new Filme();
            $filme->setName($request->request->get('filme')); // seta o nome do filme com o valor do input filme
            $this->filmeRepository->save($filme, true);// salva o filme
        }

        return $this->render('lucky/number.html.twig', [ // renderiza a view number.html.twig.
            'filmes' => $this->filmeRepository->findAll() // 'filmes' é o nome da variável que vai ser usada no template, ele irá entrar no banco de dados e pegar todos os filmes 
        ]);
    }
}

// controller é um arquivo que retorna uma resposta para o navegador -> controller: App\Controller\LuckyController::number que significa que o controller é o arquivo LuckyController.php e a função number() que retorna um objeto Response