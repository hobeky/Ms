<?php

namespace App\Entity;

use App\Repository\FoodWeekRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodWeekRepository::class)]
class FoodWeek
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?FoodDay $monday = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?FoodDay $tuesday = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?FoodDay $wednesday = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?FoodDay $thursday = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], fetch: 'EAGER')]
    private ?FoodDay $friday = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonday(): ?FoodDay
    {
        return $this->monday;
    }

    public function setMonday(?FoodDay $monday): static
    {
        $this->monday = $monday;

        return $this;
    }

    public function getTuesday(): ?FoodDay
    {
        return $this->tuesday;
    }

    public function setTuesday(?FoodDay $tuesday): static
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getWednesday(): ?FoodDay
    {
        return $this->wednesday;
    }

    public function setWednesday(?FoodDay $wednesday): static
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getThursday(): ?FoodDay
    {
        return $this->thursday;
    }

    public function setThursday(?FoodDay $thursday): static
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getFriday(): ?FoodDay
    {
        return $this->friday;
    }

    public function setFriday(?FoodDay $friday): static
    {
        $this->friday = $friday;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWeekDays(): array
    {
        return [
            'monday' => $this->getMonday(),
            'tuesday' => $this->getTuesday(),
            'wednesday' => $this->getWednesday(),
            'thursday' => $this->getThursday(),
            'friday' => $this->getFriday(),
        ];
    }
}
