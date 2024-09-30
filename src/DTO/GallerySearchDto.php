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

    public function getDatetime(): ?DateTimeImmutable
    {
        if (!$this->startYear) {
            return null;
        }

        if (!$this->month) {
            return DateTimeImmutable::createFromFormat('Y-d-m h:i:s', $this->startYear . '-1-1 0:00:00');
        }

        return DateTimeImmutable::createFromFormat('Y-d-m h:i:s', $this->startYear . '-1-' . $this->month . ' 0:00:00');
    }
}
