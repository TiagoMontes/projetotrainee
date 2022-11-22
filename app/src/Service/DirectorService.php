<?php

namespace App\Service;
use App\Repository\DirectorRepository;
use App\Entity\Director;

class DirectorService
{
    public function __construct(private DirectorRepository $directorRepository){

    }

    public function gerarDiretor(string $name):void
    {
        if($this->podeGerarDiretor($name)){
            $director = new Director();
            $director->setName($name);
            $this->directorRepository->save($director, true);
        }
    }

    public function podeGerarDiretor(string $name): bool
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