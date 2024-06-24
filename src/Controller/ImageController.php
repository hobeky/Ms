<?php

namespace App\Controller;

use App\Entity\Image;
use App\Service\ImageOptimizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ImageController extends AbstractController
{
    public function __construct(
        private ImageOptimizer        $imageOptimizer,
        private ParameterBagInterface $parameterBag
    )
    {
    }

    public function uploaded(string $imageName, string $size, Request $request): Response
    {

        assert(is_string($this->parameterBag->get('kernel.project_dir')));
        assert(is_string($this->parameterBag->get('img_dir')));
        $originalImagePath = sprintf(
            '%s%s/original/%s',
            $this->parameterBag->get('kernel.project_dir'),
            $this->parameterBag->get('img_dir'),
            $imageName
        );
        $desiredImagePath = sprintf(
            '%s%s/%s/%s',
            $this->parameterBag->get('kernel.project_dir'),
            $this->parameterBag->get('img_dir'),
            strtolower($size),
            $imageName
        );

        $host = $request->server->get('REQUEST_SCHEME') . '://' . $request->getHttpHost();
        $pathArray = explode('/', $originalImagePath);
        $imageName = end($pathArray);

        if (!file_exists($originalImagePath)) {
            throw $this->createNotFoundException(sprintf('Image %s Not Found.', $imageName));
        }

        if ($size === 'original') {
            return new BinaryFileResponse($desiredImagePath);
        }

        $imageWidth = $this->parameterBag->get($size . '_image_width');
        assert(is_int($imageWidth));
        if (!file_exists($desiredImagePath)) {
            file_put_contents(
                $desiredImagePath,
                $this->imageOptimizer->resize(
                    (string)file_get_contents($originalImagePath),
                    $imageWidth
                )
            );
        }
        return new BinaryFileResponse($desiredImagePath);
    }
}
