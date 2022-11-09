<?php

namespace App\Entity;

use App\Repository\DiretorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiretorRepository::class)]
class Diretor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

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
}
