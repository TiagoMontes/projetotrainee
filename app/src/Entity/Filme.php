<?php
//Entity é uma classe que representa uma tabela do banco de dados, ela é responsável por definir os atributos da tabela e os seus tipos, além de definir os relacionamentos entre as tabelas. 

namespace App\Entity;

use App\Repository\FilmeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmeRepository::class)]
class Filme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'filmes')] // many to one é um relacionamento de muitos para um, onde um diretor pode ter varios filmes
    #[ORM\JoinColumn(nullable: false)] // join column é uma coluna que irá fazer o relacionamento entre as tabelas
    private ?Diretor $diretor = null; // diretor é o nome da classe que representa a tabela diretor

    #[ORM\ManyToOne(inversedBy: 'Genero')]
    #[ORM\JoinColumn(nullable: false)] 
    private ?Genero $genero = null;

    #[ORM\ManyToOne(inversedBy: 'texto')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Critica $texto = null;

    // as funções abaixo são getters e setters, que são responsáveis por pegar e definir os valores dos atributos da classe

    public function getId(): ?int // retorna o id
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self 
    {
        $this->name = $name;

        return $this;
    }

    public function getDiretor(): ?Diretor
    {
        return $this->diretor;
    }

    public function setDiretor(?Diretor $diretor): self
    {
        $this->diretor = $diretor;

        return $this;
    }

    public function getGenero(): Genero
    {
        return $this->genero;
    }

    public function setGenero(Genero $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getTexto(): ?Critica
    {
        return $this->texto;
    }

    public function setTexto(?Critica $texto): self
    {
        $this->texto = $texto;

        return $this;
    }
}
