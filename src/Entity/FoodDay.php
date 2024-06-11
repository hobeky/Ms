<?php

namespace App\Entity;

use App\Repository\FoodDayRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodDayRepository::class)]
class FoodDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?Food $breakfast = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?Food $snack1 = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?Food $lunch = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?Food $snack2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreakfast(): ?Food
    {
        return $this->breakfast;
    }

    public function setBreakfast(?Food $breakfast): static
    {
        $this->breakfast = $breakfast;

        return $this;
    }

    public function getSnack1(): ?Food
    {
        return $this->snack1;
    }

    public function setSnack1(?Food $snack1): static
    {
        $this->snack1 = $snack1;

        return $this;
    }

    public function getLunch(): ?Food
    {
        return $this->lunch;
    }

    public function setLunch(?Food $lunch): static
    {
        $this->lunch = $lunch;

        return $this;
    }

    public function getSnack2(): ?Food
    {
        return $this->snack2;
    }

    public function setSnack2(?Food $snack2): static
    {
        $this->snack2 = $snack2;

        return $this;
    }

}
