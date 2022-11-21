<?php

namespace App\Service;
use App\Repository\GeneroRepository;

class GeneroService
{
    public function __construct(private GeneroRepository $generoRepository){

    }
    
    public function gerarGenero(string $titulo): void
    {
        if($this->podeGerarTitulo($titulo)){
            $genero = new Genero();
            $genero->setTitulo($titulo);
            $this->generoRepository->save($genero, true);    
        }
    }
    
    private function podeGerarTitulo(string $titulo): bool
    {
        if($titulo == null){
            return false;
        }

        $generoExistente = $this->generoRepository->findBy(["titulo" => $titulo]);
        if($generoExistente != null || strlen($titulo) <= 3){
            return false;
        }
        return true;
    }

}