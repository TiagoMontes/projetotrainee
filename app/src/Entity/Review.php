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
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')] 
    private Movie $movie;

    #[ORM\Column(length: 255)]
    private ?string $review = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(string $review): self
    {
        $this->review = $review;

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
        return ["review"=> $this->getReview(),"Id"=> $this->getId()];
    }

}