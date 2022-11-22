<?php

namespace App\Service;
use App\Repository\DirectorRepository;
use App\Entity\Director;

class DirectorService
{
    public function __construct(private DirectorRepository $directorRepository){

    }

    public function generateDirector(string $name):void
    {
        if($this->canGenerateDirector($name)){
            $director = new Director();
            $director->setName($name);
            $this->directorRepository->save($director, true);
        }
    }

    public function canGenerateDirector(string $name): bool
    {
        if($name == null){
            return false;
        }

        $existingDirector = $this->directorRepository->findBy(["name" => $name]);
        if($existingDirector != null || strlen($name) <= 3){
            return false;
        }

        return true;
    }

}