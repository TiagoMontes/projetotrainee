<?php

namespace App\Service;
use App\Repository\MovieRepository;
use App\Repository\DiretorRepository;
use App\Repository\GeneroRepository;
use App\Entity\Movie;
use App\Entity\Diretor;
use App\Entity\Genero;

class MovieService
{
    public function __construct(private MovieRepository $movieRepository, private DiretorRepository $diretorRepository, private GeneroRepository $generoRepository)
    {

    }

    public function gerarFilme(string $name, string $diretorId, string $generoId): void
    {
        if($this->podeGerarFilme($name, $diretorId, $generoId)){
            $diretor = $this->diretorRepository->find($diretorId);
            $genero = $this->generoRepository->find($generoId);

            $filme = new Filme();
            $filme->setName($name);
            $filme->setDiretor($diretor);
            $filme->setGenero($genero);
            $this->movieRepository->save($filme, true);
        }
    }

    public function podeGerarFilme(string $name, string $diretorId, string $generoId)
    {
        if($name == null || $diretorId == null || $generoId == null){
            return false;
        }

        $filmeExiste = $this->movieRepository->findBy(["name" => $name]);
        if($filmeExiste != null ){
            return false;
        }

        return true;
    }


}