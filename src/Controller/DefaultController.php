<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\Teacher;
use App\Form\ReviewType;
use App\Repository\GalleryRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('template/about.html.twig', [
            'heroName' => 'main.about'
        ]);
    }

    #[Route('/o-nas', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('template/about.html.twig', [
            'heroName' => 'main.about'
        ]);
    }

    #[Route('/recenzie', name: 'reviews')]
    public function reviews(Request $request, ReviewRepository $reviewRepository): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($review);
            $this->entityManager->flush();

            return $this->redirectToRoute('reviews');
        }

        return $this->render('template/reviews.html.twig', [
            'heroName' => 'Recenzie',
            'review' => $review,
            'form' => $form->createView(),
            'reviews' => $reviewRepository->allAsc()
        ]);
    }

//    #[Route('/clear-reviews', name: 'clear_reviews')]
//    public function clearReviews(EntityManagerInterface $entityManager): Response
//    {
//        // Create a DQL query to delete all entries from the Review entity
//        $query = $entityManager->createQuery('DELETE FROM App\Entity\Review');
//        $query->execute();
//
//        // Optionally, add a flash message or some confirmation
//        $this->addFlash('success', 'All reviews have been deleted.');
//
//        // Redirect to a confirmation page or back to the reviews page
//        return $this->redirectToRoute('reviews');
//    }

    #[Route('/kontakt', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('template/contact.html.twig', [
            'heroName' => 'main.contact'
        ]);
    }

    #[Route('/pre-rodicov', name: 'for_parents')]
    public function forParents(): Response
    {
        return $this->render('template/for-parents.html.twig', [
            'heroName' => 'main.forParents'
        ]);
    }

    #[Route('/nas-tim', name: 'teachers')]
    public function ourTeam(): Response
    {
        $teacherRepo = $this->entityManager->getRepository(Teacher::class);
        $teachers = $teacherRepo->findAll();

        return $this->render('template/teachers.html.twig', [
            'heroName' => 'main.ourTeam',
            'teachers' => $teachers
        ]);
    }

    #[Route('/galeria', name: 'gallery')]
    public function gallery(GalleryRepository $galleryRepository): Response
    {

        return $this->render('template/gallery.html.twig', [
            'heroName' => 'main.gallery',
            'gallery' => $galleryRepository->findByVisible()
        ]);
    }

    #[Route('/jedalny-listok', name: 'long_menu')]
    public function menu(): Response
    {
        return $this->render('template/meal-menu.html.twig', [
            'heroName' => 'main.menu'
        ]);
    }

    #[Route('/jedalny-listok-kratky', name: 'short_menu')]
    public function shortMenu(): Response
    {
        return $this->render('template/menu-short.html.twig', [
            'heroName' => 'main.menu'
        ]);
    }

    #[Route('/rozvrh', name: 'schedule')]
    public function schedule(): Response
    {
        return $this->render('template/time-table.html.twig', [
            'heroName' => 'main.schedule'
        ]);
    }
    #[Route('/bezpecnost-deti', name: 'child_safety')]
    public function childSafety(): Response
    {
        return $this->render('template/kid-security.html.twig', [
            'heroName' => 'main.kidSafety'
        ]);
    }

    #[Route('/udalosti', name: 'event')]
    public function event(): Response
    {
        return $this->render('template/event.html.twig', [
            'heroName' => 'main.event'
        ]);
    }
}
