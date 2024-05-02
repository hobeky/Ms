<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Translation $position = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Translation $description = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): ?Translation
    {
        return $this->position;
    }

    public function setPosition(Translation $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getDescription(): ?Translation
    {
        return $this->description;
    }

    public function setDescription(Translation $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        if (!$this->image){
            return null;
        }
        return '/image/medium/'. $this->image->getFileName();
    }

    public function setImage(string $imageName): static
    {
        $this->image = (new Image())->setFileName($imageName);

        return $this;
    }
}
