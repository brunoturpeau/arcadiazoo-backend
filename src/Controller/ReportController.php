<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Report;
use App\Entity\Food;
use App\Form\HealthFormType;
use App\Form\ReportFormType;
use App\Form\ReportType;
use App\Form\ReportWithAnimalFormType;
use App\Repository\AnimalRepository;
use App\Repository\EatingRepository;
use App\Repository\FoodRepository;
use App\Repository\ReportRepository;
use App\Repository\SuggestFeedingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/rapport')]
class ReportController extends AbstractController
{
    #[Route('/', name: 'app_report_index', methods: ['GET'])]
    public function index(ReportRepository $reportRepository): Response
    {
        $reports = $reportRepository->findby([],['date' => 'desc']);

        return $this->render('admin/report/index.html.twig', [
            'reports' => $reports,
        ]);
    }

    #[Route('/ajout', name: 'app_report_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FoodRepository $foodRepository, EatingRepository $eatingRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');

        $report = new Report();
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we retrieve the current user
            $user = $this->getUser();

            // we assign the user to the report
            $report->setUser($user);

            $entityManager->persist($report);
            $entityManager->flush();

            $this->addFlash('success', 'Rapport ajouté avec succès');

            return $this->redirectToRoute('app_report_index', [], Response::HTTP_SEE_OTHER);
        }

        $foods = $foodRepository->findBy([], ['created_at' => 'desc']);
        $food = $foods[0];
        $food_id = $food->getId();

        $eatings = $eatingRepository->findBy(['food' => $food_id]);
        return $this->render('admin/report/new_whithout_animal.html.twig', [
            'report' => $report,
            'form' => $form,
            'food' => $food,
            'eatings' => $eatings,
        ]);
    }

    #[Route('/{id}/ajout', name: 'app_report_animal_new', methods: ['GET', 'POST'])]
    public function newReport(int $id, Request $request, EntityManagerInterface $entityManager, AnimalRepository $animalRepository, FoodRepository $foodRepository, EatingRepository $eatingRepository, SuggestFeedingRepository $suggestFeedingRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');

        $report = new Report();
        $form = $this->createForm(ReportFormType::class, $report);
        $form->handleRequest($request);

        $health =  $animalRepository->findBy(['id' => $id]);
        $health = $health[0];
        $healthForm = $this->createForm(HealthFormType::class, $health);
        $healthForm->handleRequest($request);

        $animal = $animalRepository->findBy(['id' => $id]);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            $animal = $animalRepository->findBy(['id' => $id]);
            $animal = $animal[0];
            $detail = $form->get('detail')->getData();

            $report = new Report();
            $report->setDetail($detail);
            $report->setAnimal($animal);
            $report->setUser($user);
            $entityManager->persist($report);

            $entityManager->flush();

            $this->addFlash('success', 'Rapport ajouté avec succès');

            return $this->redirectToRoute('app_report_index', [], Response::HTTP_SEE_OTHER);
        }


        // We fecth the last five meals
        $lastFiveMeals = $foodRepository->findLastFiveMeals($id);

        // @todo - Sur la liste des derniers repas : ajouter l'employé qui a donné le repas

        // @todo - récupérer la composition des repas
        // findLastFiveMeals JOIN



        $suggest = $suggestFeedingRepository->findBy(['animal' => $id]);

        return $this->render('admin/report/new.html.twig', [
            'report' => $report,
            'form' => $form,
            'healthForm' => $healthForm,
            'animals' => $animal,
            'suggests' => $suggest,
            'lastFiveMeals' => $lastFiveMeals,
        ]);
    }

    #[Route('/{id}', name: 'app_report_show', methods: ['GET'])]
    public function show(Report $report, FoodRepository $foodRepository, EatingRepository $eatingRepository ): Response
    {
        $foods = $foodRepository->findBy([], ['created_at' => 'desc']);
        $food = $foods[0];
        $food_id = $food->getId();

        $eatings = $eatingRepository->findBy(['food' => $food_id]);

        return $this->render('admin/report/show.html.twig', [
            'report' => $report,
            'food' => $food,
            'eatings' => $eatings,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_report_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Report $report, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');

        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Rapport modifié avec succès');

            return $this->redirectToRoute('app_report_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/report/edit.html.twig', [
            'report' => $report,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_report_delete', methods: ['POST'])]
    public function delete(Request $request, Report $report, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');

        if ($this->isCsrfTokenValid('delete'.$report->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($report);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Rapport supprimé avec succès');

        return $this->redirectToRoute('app_report_index', [], Response::HTTP_SEE_OTHER);
    }
}
