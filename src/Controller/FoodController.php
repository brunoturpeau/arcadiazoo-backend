<?php

namespace App\Controller;

use App\Entity\Eating;
use App\Entity\Food;
use App\Form\EatingType;
use App\Form\FoodFormType;
use App\Form\FoodStepTwoFormType;
use App\Repository\EatingRepository;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/repas')]
class FoodController extends AbstractController
{
    #[Route('/', name: 'app_food_index', methods: ['GET'])]
    public function index(FoodRepository $foodRepository, EatingRepository $eatingRepository): Response
    {
        $food = $foodRepository->findBy([],['created_at' => 'desc']);
        $eatings = $eatingRepository->findAll();

        return $this->render('admin/food/index.html.twig', [
            'food' => $food,
            'eatings' => $eatings,
        ]);
    }

    #[Route('/ajout', name: 'app_food_new', methods: ['GET', 'POST'])]
    public function new(Request $request,SluggerInterface $slugger, FoodRepository $foodRepository, EntityManagerInterface $entityManager): Response
    {
        $food = new Food();
        $form = $this->createForm(FoodFormType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // We recover the data
            $date = $form->get('created_at')->getData();
            $time = $form->get('time')->getData();
            $animal = $form->get('animal')->getData();

            $food = new Food();
            $food->setCreatedAt($date);
            $food->setTime($time);
            $food->setAnimal($animal);
            $user = $this->getUser();
            $food->setUser($user);

            // we generate the slug
            $slug = 'repas-'.rand(1, 99999999);

            $slug = $slugger->slug($slug);
            $food->setSlug($slug);

            $entityManager->persist($food);
            $entityManager->flush();

            $food = $foodRepository->findBy(['slug' => $slug]);
            $food = $food[0];
            $food_id = $food->getId();

            return $this->redirectToRoute('app_food_edit_2', ['id' => $food_id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/food/new.html.twig', [
            'food' => $food,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_food_show', methods: ['GET'])]
    public function show(Food $food, EatingRepository $eatingRepository): Response
    {
        $eatings = $eatingRepository->findAll();

        return $this->render('admin/food/show.html.twig', [
            'food' => $food,
            'eatings' => $eatings,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_food_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Food $food, EatingRepository $eatingRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FoodFormType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Repas modifié avec succès');

            return $this->redirectToRoute('app_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/food/edit.html.twig', [
            'food' => $food,
            'form' => $form,
            'eatings' => $eatingRepository->findAll(),
        ]);
    }

    #[Route('/{id}/composition', name: 'app_food_edit_2', methods: ['GET', 'POST'])]
    public function editStep2(Request $request, Food $food, EatingRepository $eatingRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FoodStepTwoFormType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $food_id = $food->getId();

            $feeding = $form->get('feeding')->getData();
            $quantity = $form->get('quantity')->getData();

            $eating = new Eating();
            $eating->setFeeding($feeding);
            $eating->setQuantity($quantity);
            $eating->setFood($food);
            $entityManager->persist($eating);
            $entityManager->flush();
            $this->addFlash('success', 'Repas modifié avec succès');

            return $this->redirectToRoute('app_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/food/edit_step2.html.twig', [
            'food' => $food,
            'form' => $form,
            'eatings' => $eatingRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_food_delete', methods: ['POST'])]
    public function delete(Request $request, Food $food, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$food->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($food);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Repas supprimé avec succès');

        return $this->redirectToRoute('app_food_index', [], Response::HTTP_SEE_OTHER);
    }

}
