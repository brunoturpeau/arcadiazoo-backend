<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\CommentRepository;
use App\Repository\ReportRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $users, ServiceRepository $serviceRepository, CommentRepository $commentRepository, AnimalRepository $animalRepository, ReportRepository $reportRepository): Response
    {
        $animals = $animalRepository->findBy([],['name' => 'asc']);
        $reports = $reportRepository->findBy([]);

        return $this->render('admin/index.html.twig', [
            'users' => $users->findAll(),
            'animals' => $animals,
            'services' => $serviceRepository->findAll(),
            'comments' => $commentRepository->findAll(),
            'reports' => $reports,
        ]);
    }
}
