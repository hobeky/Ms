<?php

namespace App\Entity;

use App\Repository\HeroRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeroRepository::class)]
class Hero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $image = null;

    #[ORM\Column]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Translation $title = null;

    public function __construct()
    {
        $this->createdAt = new  DateTimeImmutable('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        if (!$this->image){
            return null;
        }
        return $this->image->getFileName();
    }

    public function setImage(string $imageName): static
    {
        $this->image = (new Image())->setFileName($imageName);

        return $this;
    }
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTitle(): ?Translation
    {
        return $this->title;
    }

    public function setTitle(?Translation $title): static
    {
        $this->title = $title;

        return $this;
    }
}
