<?php

namespace App\Service;

use App\Model\GalleryModel;
use App\Repository\GalleryRepository;

class GalleryService
{
    public function __construct(
        private GalleryRepository $galleryRepository,
    )
    {
    }

    public function process(GalleryModel $galleryModel): GalleryModel
    {
        $galleryModel
            ->setNonEmptyMonths($this->galleryRepository->findNonEmptyMonths($galleryModel))
            ->setGallery($this->galleryRepository->findByVisibleAndSearch($galleryModel))
            ->setGalleryStartDate($this->galleryRepository->getOldestRecord()?->getHappenedAt())
            ->setMaxResult($this->galleryRepository->countByVisibleAndSearch($galleryModel))
        ;
        return $galleryModel;
    }
}
