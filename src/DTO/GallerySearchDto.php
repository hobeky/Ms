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
        private ?int $month = null
    )
    {
    }

    public function getStartYear(): ?int
    {
        return $this->startYear;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function getStartDatetime(): ?DateTimeImmutable
    {
        if (!$this->startYear) {
            return null;
        }

        if (!$this->month) {
            return new DateTimeImmutable("{$this->startYear}-07-01 00:00:00");
        }

        $year = $this->startYear;
        if ($this->month < 7) {
            $year++;
        }

        return new DateTimeImmutable("{$year}-{$this->month}-01 00:00:00");
    }

    public function getEndDatetime(): ?DateTimeImmutable
    {
        if (!$this->startYear) {
            return null;
        }

        if (!$this->month) {
            return $this->getStartDatetime()->modify("+ 1 Year");
        }

        return $this->getStartDatetime()->modify("+ 1 Month");
    }
}
