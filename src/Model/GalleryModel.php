<?php

namespace App\Model;

use App\Entity\Gallery;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class  GalleryModel
{
    /**
     * @var Gallery[]
     */
    private array $gallery;

    private int $maxResult;
    private DateTimeImmutable $galleryStartDate;
    /**
     * @var int[]
     */
    private array $nonEmptyMonths;

    public function __construct(
        private int  $offset = 0,
        private int  $limit = 3,
        #[Assert\Range(min: 1900)]
        private ?int $startYear = null,
        #[Assert\Range(min: 1, max: 12)]
        private ?int $month = null,
    )
    {
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getStartYear(): int
    {
        return $this->startYear ?? (new DateTimeImmutable())->format('Y');
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function getStartDatetime(): ?DateTimeImmutable
    {
        if (!$this->getMonth()) {
            return new DateTimeImmutable("{$this->getStartYear()}-07-01 00:00:00");
        }

        $year = $this->getStartYear();
        if ($this->getMonth() < 7) {
            $year++;
        }

        return new DateTimeImmutable("{$year}-{$this->getMonth()}-01 00:00:00");
    }

    public function getEndDatetime(): ?DateTimeImmutable
    {
        if (!$this->getMonth()) {
            return $this->getStartDatetime()->modify("+ 1 Year");
        }

        return $this->getStartDatetime()->modify("+ 1 Month");
    }

    public function getGallery(): array
    {
        return $this->gallery;
    }

    public function setGallery(array $gallery): GalleryModel
    {
        if (!$this->month && $this->getNonEmptyMonths()) {
            $this->month = max($this->getNonEmptyMonths());
        }
        $this->gallery = $gallery;
        return $this;
    }

    public function getMaxResult(): int
    {
        return $this->maxResult;
    }

    public function setMaxResult(int $maxResult): GalleryModel
    {
        $this->maxResult = $maxResult;
        return $this;
    }

    public function getGalleryStartDate(): DateTimeImmutable
    {
        return $this->galleryStartDate;
    }

    public function setGalleryStartDate(DateTimeImmutable $galleryStartDate): GalleryModel
    {
        $this->galleryStartDate = $galleryStartDate;
        return $this;
    }

    public function getNonEmptyMonths(): array
    {
        return $this->nonEmptyMonths;
    }

    public function isMonthEmpty(int $month): bool
    {
        return array_search($month, $this->nonEmptyMonths) !== false;
    }

    public function setNonEmptyMonths(array $nonEmptyMonths): GalleryModel
    {
        $this->nonEmptyMonths = $nonEmptyMonths;
        return $this;
    }
}
