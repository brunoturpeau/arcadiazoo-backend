<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Form\HabitatType;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/habitat')]
class HabitatController extends AbstractController
{
    #[Route('/', name: 'app_habitat_index', methods: ['GET'])]
    public function index(HabitatRepository $habitatRepository): Response
    {
        return $this->render('admin/habitat/index.html.twig', [
            'habitats' => $habitatRepository->findAll(),
        ]);
    }

    #[Route('/ajout', name: 'app_habitat_new', methods: ['GET', 'POST'])]
    public function new(Request $request,SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $habitat = new Habitat();
        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we generate the slug
            $slug = $slugger->slug($habitat->getName());
            $habitat->setSlug($slug);

            $entityManager->persist($habitat);
            $entityManager->flush();

            return $this->redirectToRoute('app_habitat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/habitat/new.html.twig', [
            'habitat' => $habitat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habitat_show', methods: ['GET'])]
    public function show(Habitat $habitat): Response
    {
        return $this->render('admin/habitat/show.html.twig', [
            'habitat' => $habitat,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_habitat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Habitat $habitat,SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('HABITAT_EDIT', $habitat);

        $form = $this->createForm(HabitatType::class, $habitat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // we generate the slug
            $slug = $slugger->slug($habitat->getName());
            $habitat->setSlug($slug);

            $entityManager->flush();

            return $this->redirectToRoute('app_habitat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/habitat/edit.html.twig', [
            'habitat' => $habitat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habitat_delete', methods: ['POST'])]
    public function delete(Request $request, Habitat $habitat, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$habitat->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($habitat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_habitat_index', [], Response::HTTP_SEE_OTHER);
    }
}
