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
    private ?string $nome = null;

    #[ORM\OneToMany(mappedBy: 'diretor', targetEntity: Filme::class, orphanRemoval: true)]
    private Collection $filmes;

    public function __construct()
    {
        $this->filmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->nome;
    }

    public function setName(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection<int, Filme>
     */
    public function getFilmes(): Collection
    {
        return $this->filmes;
    }

    public function addFilme(Filme $filme): self
    {
        if (!$this->filmes->contains($filme)) {
            $this->filmes->add($filme);
            $filme->setDiretor($this);
        }

        return $this;
    }

    public function removeFilme(Filme $filme): self
    {
        if ($this->filmes->removeElement($filme)) {
            // set the owning side to null (unless already changed)
            if ($filme->getDiretor() === $this) {
                $filme->setDiretor(null);
            }
        }

        return $this;
    }

    public function jsonSerialize(): array
    {
        return ["Nome"=>$this->getName(),"Id"=>$this->getId()];
    }
}
