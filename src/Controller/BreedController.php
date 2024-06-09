<?php

namespace App\Controller;

use App\Entity\Breed;
use App\Form\BreedType;
use App\Repository\AnimalRepository;
use App\Repository\BreedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/race')]
class BreedController extends AbstractController
{
    #[Route('/', name: 'app_breed_index', methods: ['GET'])]
    public function index(BreedRepository $breedRepository, AnimalRepository $animalRepository): Response
    {
        $breeds = $breedRepository->findBy([],['name' => 'asc']);

        return $this->render('admin/breed/index.html.twig', [
            'breeds' => $breeds,
            'animals' => $animalRepository->findAll(),
        ]);
    }

    #[Route('/ajout', name: 'app_breed_new', methods: ['GET', 'POST'])]
    public function new(Request $request,SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $breed = new Breed();
        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we generate the slug
            $slug = $slugger->slug($breed->getName());
            $breed->setSlug($slug);

            $entityManager->persist($breed);
            $entityManager->flush();

            $this->addFlash('success', 'Race ajoutée avec succès');

            return $this->redirectToRoute('app_breed_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/breed/new.html.twig', [
            'breed' => $breed,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_breed_show', methods: ['GET'])]
    public function show(Breed $breed): Response
    {
        // we collect the animals corresponding to the breed
        $animals = $breed->getAnimals();

        return $this->render('admin/breed/show.html.twig', [
            'animals' => $animals,
            'breed' => $breed,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_breed_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Breed $breed,SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(BreedType::class, $breed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we generate the slug
            $slug = $slugger->slug($breed->getName());
            $breed->setSlug($slug);

            $entityManager->flush();

            $this->addFlash('success', 'Race modifiée avec succès');

            return $this->redirectToRoute('app_breed_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/breed/edit.html.twig', [
            'breed' => $breed,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_breed_delete', methods: ['POST'])]
    public function delete(Request $request, Breed $breed, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$breed->getId(), $request->getPayload()->get('_token'))) {

            $this->addFlash('success', 'Race supprimée avec succès');

            $entityManager->remove($breed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_breed_index', [], Response::HTTP_SEE_OTHER);
    }
}
