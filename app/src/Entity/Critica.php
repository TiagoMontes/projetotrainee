<?php

namespace App\Entity;

use App\Repository\CriticaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CriticaRepository::class)]
class Critica
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'texto', targetEntity: Filme::class)]
    private Collection $texto;

    #[ORM\Column(length: 255)]
    private ?string $critica = null;

    public function __construct()
    {
        $this->texto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCritica(): ?string
    {
        return $this->critica;
    }

    public function setCritica(string $critica): self
    {
        $this->critica = $critica;

        return $this;
    }
    
    /**
     * @return Collection<int, Filme>
     */
    public function getTexto(): Collection
    {
        return $this->texto;
    }

    public function addTexto(Filme $texto): self
    {
        if (!$this->texto->contains($texto)) {
            $this->texto->add($texto);
            $texto->setTexto($this);
        }

        return $this;
    }

    public function removeTexto(Filme $texto): self
    {
        if ($this->texto->removeElement($texto)) {
            // set the owning side to null (unless already changed)
            if ($texto->getTexto() === $this) {
                $texto->setTexto(null);
            }
        }

        return $this;
    }

}
