<?php

namespace App\Entity;

use App\Repository\SuggestFeedingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuggestFeedingRepository::class)]
class SuggestFeeding
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $feeding = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'suggestFeedings')]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(inversedBy: 'suggestFeedings')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeeding(): ?string
    {
        return $this->feeding;
    }

    public function setFeeding(?string $feeding): static
    {
        $this->feeding = $feeding;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
