<?php

namespace App\Entity;

use JsonSerializable;
use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null; // id da review

    #[ORM\ManyToOne(inversedBy: 'reviews')] // inversedBy é o nome da propriedade que está na classe Movie que faz o relacionamento com a classe Review (reviews).
    private Movie $movie; 

    #[ORM\Column(length: 255)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?int $rating = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment; 

        return $this;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function setMovie(Movie $movie) 
    {
        $this->movie = $movie;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return ["comment"=> $this->getReview(),"Id"=> $this->getId()];
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

}
