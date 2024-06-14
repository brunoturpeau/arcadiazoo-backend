<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/avis')]
class CommentController extends AbstractController
{
    #[Route('/', name: 'app_comment_index', methods: ['GET'])]
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findBy([],['created_at' => 'desc']);

        return $this->render('admin/comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/ajout', name: 'app_comment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire ajouté avec succès.');

            return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('admin/comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_comment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('COMMENT_EDIT', $comment);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire modifié avec succès.');

            return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYE');

        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->getPayload()->get('_token'))) {

            $entityManager->remove($comment);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Commentaire supprimé avec succès.');

        return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/publier', name: 'app_comment_publish', methods: ['POST'])]
    public function publish(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYE');

        if ($this->isCsrfTokenValid('publish'.$comment->getId(), $request->getPayload()->get('_token'))) {

            $comment->setVisible(1);
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Commentaire publié avec succès.');

        return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/brouillon', name: 'app_comment_unpublish', methods: ['POST'])]
    public function draftComment(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYE');

        if ($this->isCsrfTokenValid('publish'.$comment->getId(), $request->getPayload()->get('_token'))) {

            $comment->setVisible(0);
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Commentaire invalidé avec succès.');

        return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
    }



}
