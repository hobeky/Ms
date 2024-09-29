<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\GalleryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Translation $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $happenedAt = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\ManyToMany(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    private ?Collection $images;

    #[ORM\Column]
    private bool $isVisible = false;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url]
    #[Assert\Regex(
        pattern: "/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/",
        message: "The URL must be a valid YouTube link containing a 'v' parameter with a valid video ID."
    )]
    private ?string $youtubeUrl = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?Translation
    {
        return $this->title;
    }

    public function setTitle(Translation $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getHappenedAt(): ?\DateTimeImmutable
    {
        return $this->happenedAt;
    }

    public function setHappenedAt(\DateTimeImmutable $happenedAt): static
    {
        $this->happenedAt = $happenedAt;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): ?array
    {
        return $this->images->map(fn(Image $image) => $image->getFileName())->toArray();
    }

    public function addImage(string $image): static
    {
        $this->images->add((new Image())->setFileName($image));

        return $this;
    }

    public function removeImage(string $filename): static
    {
        // Attempt to find the image by filename
        foreach ($this->images as $image) {
            if ($image->getFileName() === $filename) {
                $this->images->removeElement($image);
                break;
            }
        }

        return $this;
    }


    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): static
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    public function getYoutubeUrl(): ?string
    {
        return $this->youtubeUrl;
    }

    public function setYoutubeUrl(?string $youtubeUrl): static
    {
        $this->youtubeUrl = $youtubeUrl;

        return $this;
    }

    public function getYoutubeId()
    {
        $parsedUrl = parse_url($this->youtubeUrl);
        $queryParams = [];

        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }

        return isset($queryParams['v']) ? $queryParams['v'] : null;
    }
}
