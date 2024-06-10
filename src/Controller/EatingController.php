<?php

namespace App\Controller;

use App\Entity\Eating;
use App\Form\EatingType;
use App\Repository\EatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/nourriture')]
class EatingController extends AbstractController
{
    #[Route('/', name: 'app_eating_index', methods: ['GET'])]
    public function index(EatingRepository $eatingRepository): Response
    {
        return $this->render('admin/eating/index.html.twig', [
            'eatings' => $eatingRepository->findAll(),
        ]);
    }

    #[Route('/ajout', name: 'appzzzzzz_eating_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eating = new Eating();
        $form = $this->createForm(EatingType::class, $eating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eating);
            $entityManager->flush();

            return $this->redirectToRoute('app_eating_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/eating/new.html.twig', [
            'eating' => $eating,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eating_show', methods: ['GET'])]
    public function show(Eating $eating): Response
    {
        return $this->render('admin/eating/show.html.twig', [
            'eating' => $eating,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eating_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eating $eating, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EatingType::class, $eating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_eating_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/eating/edit.html.twig', [
            'eating' => $eating,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eating_delete', methods: ['POST'])]
    public function delete(Request $request, Eating $eating, EntityManagerInterface $entityManager): Response
    {
        $food_id = $eating->getFood()->getId();

        if ($this->isCsrfTokenValid('delete'.$eating->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($eating);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_food_edit_2', ['id' => $food_id], Response::HTTP_SEE_OTHER);

    }
}
