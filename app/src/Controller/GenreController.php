<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use App\Service\GenreService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GenreController extends AbstractController
{
    public function __construct( private GenreRepository $genreRepository, private GenreService $genreService) {
    }

    #[Route('/genre/list', name: 'genre_list', methods: ['GET'])]
    public function genre()
    {
        $genreList = $this->genreRepository->findAll();

        return $this->render('genre/index.html.twig', [
            'genres' => $genreList
        ]);
    }

    #[Route('/genre/new', name: 'genre_new', methods: ['POST'])]
    public function newGenre(Request $request)
    {
        $genreName = $request->request->get('genero');
        $this->genreService->generateGenre($genreName);

        return $this->redirect('/genre/list');
    }


    #[Route('/genre/delete', name: 'genre_delete', methods: ['POST'])] 
    public function deleteGenre(Request $request)
    {
        $genreId = ($request->request->get('id'));
        $genre = $this->genreRepository->find($genreId);

        if($genre){
            $this->genreRepository->remove($genre, true);
        }

        return $this->redirect('/genre/list');
    }

    #[Route('/genre/edit', name: 'genre_edit', methods: ['POST'])]
    public function editGenre(Request $request)
    {

        $genreName = $request->request->get('genero'); //Estamos fazendo uma requisição para PEGAR 'genero' do front-end
        $genreId = $request->request->get('id'); // Estamos requisitando o Id

        $genre = $this->genreRepository->find($genreId); // vamos procurar o id no nosso banco de dados
        $genre->setName($genreName);// Após identificarmos o ID, definiremos o setTitulo sendo o nome puxando em $generoName pelo input

        if($genreName != null){
            $this->genreRepository->save($genre, true);
        }

        return $this->redirect('/genre/list');

    }
}
