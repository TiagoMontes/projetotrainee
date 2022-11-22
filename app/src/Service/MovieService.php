<?php

namespace App\Service;
use App\Repository\MovieRepository;
use App\Repository\DirectorRepository;
use App\Repository\GenreRepository;
use App\Entity\Movie;
use App\Entity\Director;
use App\Entity\Genre;

class MovieService
{
    public function __construct(private MovieRepository $movieRepository, private DirectorRepository $directorRepository, private GenreRepository $genreRepository)
    {

    }

    public function generateMovie(string $name, string $directorId, string $generoId): void
    {
        if($this->canGenerateMovie($name, $directorId, $generoId)){
            $director = $this->directorRepository->find($directorId);
            $genero = $this->genreRepository->find($generoId);

            $movie = new Movie();
            $movie->setName($name);
            $movie->setDirector($director);
            $movie->setGenre($genero);
            $this->movieRepository->save($movie, true);
        }
    }

    public function canGenerateMovie(string $name, string $directorId, string $generoId)
    {
        if($name == null || $directorId == null || $generoId == null){
            return false;
        }

        $filmeExiste = $this->movieRepository->findBy(["name" => $name]);
        if($filmeExiste != null ){
            return false;
        }

        return true;
    }


}