<?php

namespace App\DTO;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class GallerySearchDto
{
    public function __construct(
        #[Assert\Range(min: 1900)]
        private ?int $startYear = null,
        #[Assert\Range(min: 1, max: 12)]
        private ?int $month = null,
        private int $offset = 0,
        private int $limit = 3,
    )
    {
    }

    public function getStartYear(): int
    {
        return $this->startYear??(new DateTimeImmutable())->format('Y');
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
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
}
