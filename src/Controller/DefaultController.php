<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger
    )
    {

    }
    #[Route('/default/{templateName}', name: 'app_default')]
    public function index(?string $templateName = null): Response
    {
        if (is_null($templateName)){
            return $this->render('template/index.html.twig');
        }

        $templatePath = 'template/' . $templateName . '.html.twig';

        return  $this->render($templatePath, [
            'heroName' => $templateName
        ]);

    }
}
