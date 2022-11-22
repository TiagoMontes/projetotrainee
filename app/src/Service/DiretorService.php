<?php

namespace App\Service;
use App\Repository\DiretorRepository;
use App\Entity\Diretor;

class DiretorService
{
    public function __construct(private DiretorRepository $diretorRepository){

    }

    public function gerarDiretor(string $name):void
    {
        if($this->podeGerarDiretor($name)){
            $diretor = new Diretor();
            $diretor->setName($name);
            $this->diretorRepository->save($diretor, true);
        }
    }

    public function podeGerarDiretor(string $name): bool
    {
        if($name == null){
            return false;
        }

        $diretorExistente = $this->diretorRepository->findBy(["name" => $name]);
        if($diretorExistente != null || strlen($name) <= 3){
            return false;
        }

        return true;
    }

}