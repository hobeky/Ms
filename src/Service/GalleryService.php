<?php

namespace App\Service;

use App\Model\GalleryModel;
use App\Repository\GalleryRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GalleryService
{
    public function __construct(
        private GalleryRepository $galleryRepository,
    )
    {
    }

    public function process(GalleryModel $galleryModel): GalleryModel
    {
        if ($this->galleryRepository->getOldestRecord() == null) {
            throw new NotFoundHttpException('No Gallery found');
        }

        $galleryModel
            ->setNonEmptyMonths($this->galleryRepository->findNonEmptyMonths($galleryModel))
            ->setGallery($this->galleryRepository->findByVisibleAndSearch($galleryModel))
            ->setGalleryStartDate($this->galleryRepository->getOldestRecord()?->getHappenedAt())
            ->setMaxResult($this->galleryRepository->countByVisibleAndSearch($galleryModel))
        ;
        return $galleryModel;
    }
}
