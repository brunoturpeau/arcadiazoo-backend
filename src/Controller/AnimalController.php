<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Image;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Repository\EatingRepository;
use App\Repository\FoodRepository;
use App\Repository\ReportRepository;
use App\Service\PictureService;
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
    public function new(Request $request,SluggerInterface $slugger, EntityManagerInterface $entityManager, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // We recover the images
            $images = $form->get('images')->getData();


            foreach($images as $image){
                // We define the destination folder
                $folder = 'animals';
                // We call the add service
                $file = $pictureService->add($image, $folder, 300, 300);

                $img = new Image();
                $img->setTitle($file);
                $img->setName($file);
                $animal->addImage($img);
            }
            // we generate the slug
            $slug = $slugger->slug($animal->getName())->lower();
            $animal->setSlug($slug);

            $entityManager->persist($animal);
            $entityManager->flush();

            $this->addFlash('success', 'Animal ajouté avec succès');

            return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_show', methods: ['GET'])]
    public function show(Animal $animal, ReportRepository $reportRepository, FoodRepository $foodRepository, EatingRepository $eatingRepository): Response
    {
        $foods = $foodRepository->findBy([], ['created_at' => 'desc']);

        return $this->render('admin/animal/show.html.twig', [
            'animal' => $animal,
            'reports' => $reportRepository->findAll(),
            'foods' => $foods,
            'eatings' => $eatingRepository->findAll(),
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

            $this->addFlash('success', 'Animal modifié avec succès.');

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

            $this->addFlash('success', 'Animal supprimé avec succès.');

            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/image/{id}', name: 'app_animal_image_delete', methods: ['POST'])]
    public function deleteImg(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->getPayload()->get('_token'))) {



            $this->addFlash('success', "L'image a été supprimée avec succès.");

            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
