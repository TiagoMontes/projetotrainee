<?php

namespace App\Entity;

use JsonSerializable;
use App\Repository\DiretorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiretorRepository::class)] //DiretorRepository é a classe que gerencia a entidade Diretor no banco de dados, ela é uma boa pratica para separar as responsabilidades de cada classe e facilitar a manutenção do código.
class Diretor implements JsonSerializable 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'diretor', targetEntity: Movie::class, orphanRemoval: true)]
    private Collection $films;

    public function __construct()
    {
        $this->films = new ArrayCollection();
    }

    public function getId(): ?int
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

    /**
     * @return Collection<int, Filme>
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->films->contains($movie)) {
            $this->films->add($movie);
            $movie->setDiretor($this);
        }

        return $this;
    }

    public function removeFilme(Movie $name): self
    {
        if ($this->name->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getDiretor() === $this) {
                $name->setDiretor(null);
            }
        }

        return $this;
    }

    public function jsonSerialize(): array
    {
        return ["Name"=>$this->getName(),"Id"=>$this->getId()];
    }
}
