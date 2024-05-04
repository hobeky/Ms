<?php

namespace App\Controller;

use App\Entity\Teacher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    #[Route('/o-nas', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('template/about.html.twig', [
            'heroName' => 'about us'
        ]);
    }

    #[Route('/recenzie', name: 'reviews')]
    public function reviews(): Response
    {
        return $this->render('template/reviews.html.twig', [
            'heroName' => 'about us'
        ]);
    }

    #[Route('/kontakt', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('template/contact.html.twig', [
            'heroName' => 'about us'
        ]);
    }

    #[Route('/pre-rodicov', name: 'for_parents')]
    public function forParents(): Response
    {
        return $this->render('template/for-parents.html.twig', [
            'heroName' => 'about us'
        ]);
    }

    #[Route('/nas-tim', name: 'teachers')]
    public function ourTeam(): Response
    {
        $teacherRepo = $this->entityManager->getRepository(Teacher::class);
        $teachers = $teacherRepo->findAll();

        return $this->render('template/teachers.html.twig', [
            'heroName' => 'about us',
            'teachers' => $teachers
        ]);
    }

    #[Route('/galeria', name: 'gallery')]
    public function gallery(): Response
    {
        return $this->render('template/gallery.html.twig', [
            'heroName' => 'about us'
        ]);
    }

    #[Route('/jedalny-listok', name: 'long_menu')]
    public function menu(): Response
    {
        return $this->render('template/meal-menu.html.twig', [
            'heroName' => 'about us'
        ]);
    }

    #[Route('/jedalny-listok-kratky', name: 'short_menu')]
    public function shortMenu(): Response
    {
        return $this->render('template/menu-short.html.twig', [
            'heroName' => 'about us'
        ]);
    }

    #[Route('/rozvrh', name: 'schedule')]
    public function schedule(): Response
    {
        return $this->render('template/time-table.html.twig', [
            'heroName' => 'about us'
        ]);
    }
    #[Route('/bezpecnost-deti', name: 'child_safety')]
    public function childSafety(): Response
    {
        return $this->render('template/kid-security.html.twig', [
            'heroName' => 'about us'
        ]);
    }
}
