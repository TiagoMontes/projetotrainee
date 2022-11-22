<?php

// Uma entidade é uma classe que representa uma tabela do banco de dados, ela é responsável por definir os atributos da tabela e os seus tipos, além de definir os relacionamentos entre as tabelas. 

namespace App\Entity;

use JsonSerializable;
use App\Repository\GeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\OneToMany(mappedBy: 'genero', targetEntity: Filme::class)] // temos uma relação de um para muitos, ou seja, um gênero pode ter vários filmes. targetEntity é a entidade que está sendo relacionada, no caso, a entidade Filme e mappedBy é o atributo que está sendo relacionado, no caso, o atributo genero da entidade Filme
    private Collection $filme;

    public function __construct()
    {
        $this->filme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function addFilme(Filme $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name->add($name);
            $name->setGenero($this);
        }

        return $this;
    }

    public function removeFilme(Filme $name): self
    {
        if ($this->name->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getGenero() === $this) {
                $name->setGenero(null);
            }
        }

        return $this;
    }

    public function jsonSerialize(): array
    {
        return ["Titulo"=>$this->getTitulo(),"Id"=>$this->getId()];
    }
}
