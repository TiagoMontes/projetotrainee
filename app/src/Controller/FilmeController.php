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
    
    #[Route('/filme', name: 'filme_list', methods: ['GET','POST'])] // rota é o caminho que o usuário acessa
    public function filmes(Request $request): Response
    {

        if($request->request->all()){
            $filme = new Filme();
            $filme->setName($request->request->get('filme')); // seta o nome do filme
            $this->filmeRepository->save($filme, true);// salva o filme
        }

        return $this->render('lucky/number.html.twig', [ // retorna um objeto response com o template number.html.twig
            'filmes' => $this->filmeRepository->findAll()
        ]);
    }
}

// controller é um arquivo que retorna uma resposta para o navegador -> controller: App\Controller\LuckyController::number que significa que o controller é o arquivo LuckyController.php e a função number() que retorna um objeto Response