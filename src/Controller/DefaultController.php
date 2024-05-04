<?php

namespace App\Controller;

use App\Entity\Teacher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {

    }
    #[Route('/default/{templateName}', name: 'app_default')]
    public function index(?string $templateName = null): Response
    {
        if (is_null($templateName)){
            $templateName = 'about';
        }

        $teacherRepo = $this->entityManager->getRepository(Teacher::class);
        $teachers = $teacherRepo->findAll();
        $templatePath = 'template/' . $templateName . '.html.twig';


        return  $this->render($templatePath, [
            'heroName' => $templateName,
            'teachers' => $teachers
        ]);

    }
}
