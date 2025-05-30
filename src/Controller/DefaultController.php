<?php

namespace App\Controller;

use App\Model\GalleryModel;
use App\Entity\Contact;
use App\Entity\Review;
use App\Entity\Teacher;
use App\Form\ContactType;
use App\Form\ReviewType;
use App\Repository\EventRepository;
use App\Repository\FoodWeekRepository;
use App\Repository\GalleryRepository;
use App\Repository\ReviewRepository;
use App\Service\GalleryService;
use Doctrine\ORM\EntityManagerInterface;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
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
            'heroName' => 'main.about',
            'page_title' => 'page.title.home',
            'page_description' => 'page.description.home',
            'page_keywords' => 'page.keywords.home'
        ]);
    }

    #[Route('/o-nas', name: 'about_us')]
    public function aboutUs(): Response
    {
        return $this->render('template/about.html.twig', [
            'heroName' => 'main.about',
            'page_title' => 'page.title.about_us',
            'page_description' => 'page.description.about_us',
            'page_keywords' => 'page.keywords.about_us'
        ]);
    }

    #[Route('/recenzie', name: 'reviews')]
    public function reviews(
        Request             $request,
        ReviewRepository    $reviewRepository,
        Recaptcha3Validator $recaptcha3Validator
    ): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $score = $recaptcha3Validator->getLastResponse()->getScore();
            $this->entityManager->persist($review);
            $this->entityManager->flush();

            return $this->redirectToRoute('reviews');
        }

        return $this->render('template/reviews.html.twig', [
            'heroName' => 'main.reviews',
            'review' => $review,
            'form' => $form->createView(),
            'reviews' => $reviewRepository->allAsc(),
            'page_title' => 'page.title.reviews',
            'page_description' => 'page.description.reviews',
            'page_keywords' => 'page.keywords.reviews',
            'siteKey' => $this->getParameter('captchaKey')
        ]);
    }

    #[Route('/kontakt', name: 'contact')]
    public function contact(Request $request): Response
    {
        $email = new Contact();
        $form = $this->createForm(ContactType::class, $email);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // Handle form data (e.g., send email, save to database, etc.)
            $this->entityManager->persist($email);
            $this->entityManager->flush();
            // Add a flash message
            $this->addFlash('success', 'Your message has been sent!');

            // Redirect to avoid re-submitting the form on page refresh
            return $this->redirectToRoute('contact');
        }

        return $this->render('template/contact.html.twig', [
            'heroName' => 'main.contact',
            'page_title' => 'page.title.contact',
            'page_description' => 'page.description.contact',
            'page_keywords' => 'page.keywords.contact',
            'form' => $form->createView(),
            'siteKey' => $this->getParameter('captchaKey'),
        ]);
    }

    #[Route('/pre-rodicov', name: 'for_parents')]
    public function forParents(): Response
    {
        return $this->render('template/for-parents.html.twig', [
            'heroName' => 'main.forParents',
            'page_title' => 'page.title.for_parents',
            'page_description' => 'page.description.for_parents',
            'page_keywords' => 'page.keywords.for_parents'
        ]);
    }

    #[Route('/nas-tim', name: 'teachers')]
    public function ourTeam(): Response
    {
        $teacherRepo = $this->entityManager->getRepository(Teacher::class);
        $teachers = $teacherRepo->findAll();

        return $this->render('template/teachers.html.twig', [
            'heroName' => 'main.ourTeam',
            'teachers' => $teachers,
            'page_title' => 'page.title.teachers',
            'page_description' => 'page.description.teachers',
            'page_keywords' => 'page.keywords.teachers'
        ]);
    }

    #[Route('/galeria', name: 'gallery')]
    public function gallery(GalleryService $galleryService, #[MapQueryString]GalleryModel $galleryModel = new GalleryModel()): Response
    {
        $galleryModel = $galleryService->process($galleryModel);
        return $this->render('template/gallery.html.twig', [
            'heroName' => 'main.gallery',
            'gallery' => $galleryModel,
            'page_title' => 'page.title.gallery',
            'page_description' => 'page.description.gallery',
            'page_keywords' => 'page.keywords.gallery',
        ]);
    }

    #[Route('/jedalny-listok', name: 'long_menu')]
    public function menu(FoodWeekRepository $foodWeekRepository): Response
    {
        // Get all FoodWeek entities
        $foodWeeks = $foodWeekRepository->findAll();

        // Filter the most recent FoodWeek
        $recentFoodWeek = null;
        if (!empty($foodWeeks)) {
            usort($foodWeeks, function ($a, $b) {
                return $b->getCreatedAt() <=> $a->getCreatedAt();
            });
            $recentFoodWeek = $foodWeeks[0];
        }

        return $this->render('template/meal-menu.html.twig', [
            'heroName' => 'main.menu',
            'foodWeek' => $recentFoodWeek,
            'page_title' => 'page.title.long_menu',
            'page_description' => 'page.description.long_menu',
            'page_keywords' => 'page.keywords.long_menu'
        ]);
    }

    #[Route('/jedalny-listok-kratky', name: 'short_menu')]
    public function shortMenu(FoodWeekRepository $foodWeekRepository): Response
    {
        // Get all FoodWeek entities
        $foodWeeks = $foodWeekRepository->findAll();

        // Filter the most recent FoodWeek
        $recentFoodWeek = null;
        if (!empty($foodWeeks)) {
            usort($foodWeeks, function ($a, $b) {
                return $b->getCreatedAt() <=> $a->getCreatedAt();
            });
            $recentFoodWeek = $foodWeeks[0];
        }

        return $this->render('template/menu-short.html.twig', [
            'heroName' => 'main.menu',
            'foodWeek' => $recentFoodWeek,
            'page_title' => 'page.title.short_menu',
            'page_description' => 'page.description.short_menu',
            'page_keywords' => 'page.keywords.short_menu'
        ]);
    }

    #[Route('/rozvrh', name: 'schedule')]
    public function schedule(): Response
    {
        return $this->render('template/time-table.html.twig', [
            'heroName' => 'main.schedule',
            'page_title' => 'page.title.schedule',
            'page_description' => 'page.description.schedule',
            'page_keywords' => 'page.keywords.schedule'
        ]);
    }

    #[Route('/bezpecnost-deti', name: 'child_safety')]
    public function childSafety(): Response
    {
        return $this->render('template/kid-security.html.twig', [
            'heroName' => 'main.kidSafety',
            'page_title' => 'page.title.child_safety',
            'page_description' => 'page.description.child_safety',
            'page_keywords' => 'page.keywords.child_safety'
        ]);
    }

    #[Route('/udalosti', name: 'event')]
    public function event(EventRepository $eventRepository): Response
    {
        return $this->render('template/event.html.twig', [
            'heroName' => 'main.event',
            'events' => $eventRepository->findAll(),
            'page_title' => 'page.title.event',
            'page_description' => 'page.description.event',
            'page_keywords' => 'page.keywords.event'
        ]);
    }


    #[Route('/cennik', name: 'pricing')]
    public function pricing(): Response
    {
        return $this->render('template/pricing.html.twig', [
            'heroName' => 'main.pricing',
            'page_title' => 'page.title.event',
            'page_description' => 'page.description.event',
            'page_keywords' => 'page.keywords.event'
        ]);
    }
}
