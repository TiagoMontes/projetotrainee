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

    public function generateMovie(string $name, string $directorId, string $genreId): void
    {
        if($this->canGenerateMovie($name, $directorId, $genreId)){
            $director = $this->directorRepository->find($directorId);
            $genre = $this->genreRepository->find($genreId);

            $movie = new Movie();
            $movie->setName($name);
            $movie->setDirector($director);
            $movie->setGenre($genre);
            $this->movieRepository->save($movie, true);
        }
    }

    public function canGenerateMovie(string $name, string $directorId, string $genreId)
    {
        if($name == null || $directorId == null || $genreId == null){
            return false;
        }

        $movieExist = $this->movieRepository->findBy(["name" => $name]);
        if($movieExist != null ){
            return false;
        }

        return true;
    }


}