<?php

namespace App\Entity;

use App\Repository\GeneroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GeneroRepository::class)]
class Genero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\OneToMany(mappedBy: 'genero', targetEntity: Filme::class)]
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

    public function addFilme(Filme $filme): self
    {
        if (!$this->filme->contains($filme)) {
            $this->filme->add($filme);
            $filme->setGenero($this);
        }

        return $this;
    }

    public function removeFilme(Filme $filme): self
    {
        if ($this->filme->removeElement($filme)) {
            // set the owning side to null (unless already changed)
            if ($filme->getGenero() === $this) {
                $filme->setGenero(null);
            }
        }

        return $this;
    }
}
