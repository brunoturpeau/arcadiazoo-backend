<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\CommentRepository;
use App\Repository\FoodRepository;
use App\Repository\HabitatRepository;
use App\Repository\ReportRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $users, ServiceRepository $serviceRepository, CommentRepository $commentRepository, AnimalRepository $animalRepository, ReportRepository $reportRepository, HabitatRepository $habitatRepository, FoodRepository $foodRepository): Response
    {
        $animals = $animalRepository->findBy([],['name' => 'asc']);

        $habitat = $habitatRepository->findBy(['name' => 'Savane']);
        $habitat_id = $habitat[0]->getId();
        $savannahAnimals = $animalRepository->savannahAnimals($habitat_id);

        $habitat = $habitatRepository->findBy(['name' => 'Marais']);
        $habitat_id = $habitat[0]->getId();
        $marshAnimals = $animalRepository->savannahAnimals($habitat_id);

        $habitat = $habitatRepository->findBy(['name' => 'Jungle']);
        $habitat_id = $habitat[0]->getId();
        $jungleAnimals = $animalRepository->savannahAnimals($habitat_id);

// dd($jungleAnimals);

        $reports = $reportRepository->findBy([]);
        $comments = $commentRepository->findBy([],['created_at' => 'desc']);
        $food = $foodRepository->findBy([],['created_at' => 'desc']);

        return $this->render('admin/index.html.twig', [
            'users' => $users->findAll(),
            'animals' => $animals,
            'services' => $serviceRepository->findAll(),
            'comments' => $comments,
            'reports' => $reports,
            'food' => $food,
            'habitats' => $habitatRepository->findAll(),
            'savannahAnimals' => $savannahAnimals,
            'marshAnimals' => $marshAnimals,
            'jungleAnimals' => $jungleAnimals,
        ]);
    }
}
