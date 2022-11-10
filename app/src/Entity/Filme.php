<?php

namespace App\Entity;

use App\Repository\FilmeRepository;
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

    #[ORM\ManyToOne(inversedBy: 'filmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Diretor $diretor = null;

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

    public function getDiretor(): ?Diretor
    {
        return $this->diretor;
    }

    public function setDiretor(?Diretor $diretor): self
    {
        $this->diretor = $diretor;

        return $this;
    }
}
