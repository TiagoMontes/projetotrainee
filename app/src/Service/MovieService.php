<?php

namespace App\Service;
use App\Repository\MovieRepository;
use App\Repository\DirectorRepository;
use App\Repository\GeneroRepository;
use App\Entity\Movie;
use App\Entity\Diretor;
use App\Entity\Genero;

class MovieService
{
    public function __construct(private MovieRepository $movieRepository, private DirectorRepository $directorRepository, private GeneroRepository $generoRepository)
    {

    }

    public function generateMovie(string $name, string $directorId, string $generoId): void
    {
        if($this->canGenerateMovie($name, $directorId, $generoId)){
            $director = $this->directorRepository->find($directorId);
            $genero = $this->generoRepository->find($generoId);

            $movie = new Movie();
            $movie->setName($name);
            $movie->setDirector($director);
            $movie->setGenero($genero);
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