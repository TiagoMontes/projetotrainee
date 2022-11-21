<?php

namespace App\Service;
use App\Repository\DiretorRepository;
use App\Entity\Diretor;

class DiretorService
{
    public function __construct(private DiretorRepository $diretorRepository){

    }

    public function gerarDiretor(string $nome):void
    {
        if($this->podeGerarDiretor($nome)){
            $diretor = new Diretor();
            $diretor->setName($nome);
            $this->diretorRepository->save($diretor, true);
        }
    }

    public function podeGerarDiretor(string $nome): bool
    {
        if($nome == null){
            return false;
        }

        $diretorExistente = $this->diretorRepository->findBy(["nome" => $nome]);
        if($diretorExistente != null || strlen($nome) <= 3){
            return false;
        }

        return true;
    }

}