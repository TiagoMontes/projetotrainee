<?php

namespace App\Service;
use App\Repository\GenreRepository;
use App\Entity\Genre;

class GenreService
{
    public function __construct(private GenreRepository $genreRepository){

    }
    
    public function generateGenre(string $name): void
    {
        if($this->canGenerateGenre($name)){
            $genre = new Genre();
            $genre->setName($name);
            $this->genreRepository->save($genre, true);    
        }
    }
    
    private function canGenerateGenre(string $name): bool
    {
        if($name == null){
            return false;
        }

        $genreExist = $this->genreRepository->findBy(["name" => $name]);
        if($genreExist != null || strlen($name) <= 3){
            return false;
        }
        return true;
    }

}