<?php

declare(strict_types=1);

namespace App\Service;

use Exception;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

readonly class ImageOptimizer
{
    private Imagine $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function resize(?string $image, int $width, int $height = -1): string
    {
        if ($image === null || $image === '' || $image === '0') {
            throw new Exception('No image data provided');
        }
        $imageData = getimagesizefromstring($image);
        if (! $imageData) {
            throw new Exception('Wrong image data provided');
        }

        [$iwidth, $iheight] = $imageData;
        $ratio = $iwidth / $iheight;
        if ($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $photo = $this->imagine->load($image);
        $mimeArray = explode('/', (string) $this->getMime($image));
        return $photo->resize(new Box($width, (int) $height))->get(end($mimeArray));
    }

    public function getMime(string $imageData): string
    {
        $imageSize = getimagesizefromstring($imageData);
        if (empty($imageSize['mime'])) {
            throw new Exception('Cannot find MIME type');
        }
        return (string) $imageSize['mime'];
    }
}
