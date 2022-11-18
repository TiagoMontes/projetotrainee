<?php

namespace App\Entity;

use JsonSerializable;
use App\Repository\CriticaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CriticaRepository::class)]
class Critica implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'criticas')] 
    private Filme $filme;

    #[ORM\Column(length: 255)]
    private ?string $critica = null;

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
    

    public function getFilme(): Filme
    {
        return $this->filme;
    }

    public function setFilme(Filme $filme) 
    {
        $this->filme = $filme;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return ["Critica"=> $this->getCritica(),"Id"=> $this->getId()];
    }

}
