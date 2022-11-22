<?php

namespace App\Entity;

use JsonSerializable;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'films')] // a relação many
    #[ORM\JoinColumn(nullable: false)] 
    private ?Director $director = null;

    #[ORM\ManyToOne(inversedBy: 'Genero')] 
    #[ORM\JoinColumn(nullable: false)] 
    private ?Genero $genero = null;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: Critica::class)] // 
    private Collection $criticas;  // Collection é uma classe do Doctrine que representa uma coleção de objetos, no caso uma coleção de objetos do tipo Critica, que é a entidade que representa a tabela crítica no banco de dados.

    // as funções abaixo são getters e setters, que são responsáveis por pegar e definir os valores dos atributos da classe

    public function __construct()
    {
        $this->criticas = new ArrayCollection();
    }

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

    public function getDirector(): ?Director
    {
        return $this->director;
    }

    public function setDirector(?Director $director): self 
    {
        $this->director = $director;

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

    /**
     * @return Collection<int, Filme> 
     */
    public function getCriticas(): Collection
    {
        return $this->criticas;
    }

    public function addCritica(Critica $critica): self
    {
        if (!$this->criticas->contains($critica)) {
            $this->criticas->add($critica);
            $critica->setFilme($this);
        }

        return $this;
    }

    public function removeCritica(Critica $critica): self
    {
        if ($this->criticas->removeElement($critica)) {
            // set the owning side to null (unless already changed)
            if ($critica->getMovie() === $this) {
                $critica->setMovie(null);
            }
        }

        return $this;
    }


    public function jsonSerialize(): array
    {
        return ["Movie"=>$this->getName(),"Id"=>$this->getId()];
    }

}
