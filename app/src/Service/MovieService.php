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

    public function generateMovie(string $movie, string $directorId, string $genreId): void
    {
        if($this->canGenerateMovie($movie, $directorId, $genreId)){
            $director = $this->directorRepository->find($directorId);
            $genre = $this->genreRepository->find($genreId);

            $movie = new Movie();
            $movie->setName($movie);
            $movie->setDirector($director);
            $movie->setGenre($genre);
            $this->movieRepository->save($movie, true);
        }
    }

    public function canGenerateMovie(string $movie, string $directorId, string $genreId)
    {
        if($movie == null || $directorId == null || $genreId == null){
            return false;
        }

        $movieExist = $this->movieRepository->findBy(["name" => $movie]);
        if(!is_null($movieExist)){
            return false;
        }

        return true;
    }
}