<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Repository\ReportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/animal')]
class AnimalController extends AbstractController
{
    #[Route('/', name: 'app_animal_index', methods: ['GET'])]
    public function index(AnimalRepository $animalRepository, ReportRepository $reportRepository): Response
    {
        $animals = $animalRepository->findby([],['name' => 'asc']);

        return $this->render('admin/animal/index.html.twig', [
            'animals' => $animals,
            'reports' => $reportRepository->findAll(),
        ]);
    }

    #[Route('/ajout', name: 'app_animal_new', methods: ['GET', 'POST'])]
    public function new(Request $request,SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we generate the slug
            $slug = $slugger->slug($animal->getName());
            $animal->setSlug($slug);

            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_show', methods: ['GET'])]
    public function show(Animal $animal, ReportRepository $reportRepository): Response
    {
        return $this->render('admin/animal/show.html.twig', [
            'animal' => $animal,
            'reports' => $reportRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edition', name: 'app_animal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,SluggerInterface $slugger, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ANIMAL_EDIT', $animal);

        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we generate the slug
            $slug = $slugger->slug($animal->getName());
            $animal->setSlug($slug);

            $entityManager->flush();

            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_delete', methods: ['POST'])]
    public function delete(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
