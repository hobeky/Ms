<?php

namespace App\Entity;

use App\Repository\TranslationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
class Translation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5000)]
    private ?string $sk = null;

    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $en = null;


    public function __toString(): string
    {
        $locale = $GLOBALS['currentLocale'];
        return $this->$locale;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSk(): ?string
    {
        return $this->sk;
    }

    public function setSk(string $sk): static
    {
        $this->sk = $sk;

        return $this;
    }

    public function getEn(): ?string
    {
        return $this->en;
    }

    public function setEn(?string $en): static
    {
        $this->en = $en;

        return $this;
    }
}
