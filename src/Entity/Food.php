<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $time = null;

    #[ORM\ManyToOne(inversedBy: 'food')]
    private ?Animal $animal = null;

    /**
     * @var Collection<int, Eating>
     */
    #[ORM\OneToMany(targetEntity: Eating::class, mappedBy: 'food')]
    private Collection $eatings;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->eatings = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): static
    {
        $this->time = $time;

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

    /**
     * @return Collection<int, Eating>
     */
    public function getEatings(): Collection
    {
        return $this->eatings;
    }

    public function addEating(Eating $eating): static
    {
        if (!$this->eatings->contains($eating)) {
            $this->eatings->add($eating);
            $eating->setFood($this);
        }

        return $this;
    }

    public function removeEating(Eating $eating): static
    {
        if ($this->eatings->removeElement($eating)) {
            // set the owning side to null (unless already changed)
            if ($eating->getFood() === $this) {
                $eating->setFood(null);
            }
        }

        return $this;
    }
}
