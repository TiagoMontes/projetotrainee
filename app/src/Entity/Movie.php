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

    #[ORM\ManyToOne(inversedBy: 'movies')] // a relação many
    #[ORM\JoinColumn(nullable: false)] 
    private ?Director $director = null;

    #[ORM\ManyToOne(inversedBy: 'movies')] 
    #[ORM\JoinColumn(nullable: false)] 
    private ?Genre $genre = null;

    #[ORM\OneToMany( mappedBy: 'movie', targetEntity: Review::class)] // 
    private Collection $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
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

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }


    /**
     * @return Collection<int, Filme> 
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setMovie($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            if ($review->getMovie() === $this) {
                $review->setMovie(null);
            }
        }

        return $this;
    }


    public function jsonSerialize(): array
    {
        return ["movie"=>$this->getName(),"Id"=>$this->getId()];
    }

}
