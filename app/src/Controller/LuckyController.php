<?php
// src/Controller/LuckyController.php
namespace App\Controller; // namespace é o caminho do arquivo

use App\Entity\Filme;
use App\Repository\FilmeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    public function __construct( private FilmeRepository $filmeRepository, private EntityManagerInterface $em ) { // construtor é o trecho de código que é executado junto com a instanciação da classe
    }
    
    #[Route('/filme', name: 'filme_list', methods: ['GET'])] // rota é o caminho que o usuário acessa
    public function filmes(): Response 
    {

        $filme = new Filme();
        $filme->setName("Onde os fracos tem vez");
        $this->em->persist($filme); // this faz ele procurar em toda a classe // persist faz ele salvar no banco de dados
        $this->em->flush(); // flush atualiza o banco de dados
        $filmes = $this -> filmeRepository -> findAll();
        dd($filmes);

    }
}

// controller é um arquivo que retorna uma resposta para o navegador -> controller: App\Controller\LuckyController::number que significa que o controller é o arquivo LuckyController.php e a função number() que retorna um objeto Response