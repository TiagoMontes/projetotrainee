<?php

namespace App\Service;
use App\Repository\FilmeRepository;
use App\Repository\DiretorRepository;
use App\Repository\GeneroRepository;
use App\Entity\Filme;
use App\Entity\Diretor;
use App\Entity\Genero;

class FilmeService
{
    public function __construct(private FilmeRepository $filmeRepository, private DiretorRepository $diretorRepository, private GeneroRepository $generoRepository)
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
            $this->filmeRepository->save($filme, true);
        }
    }

    public function podeGerarFilme(string $name, string $diretorId, string $generoId)
    {
        if($name == null || $diretorId == null || $generoId == null){
            return false;
        }

        $filmeExiste = $this->filmeRepository->findBy(["name" => $name]);
        if($filmeExiste != null ){
            return false;
        }

        return true;
    }


}