<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(AuthenticationUtils $authenticationUtils, UserRepository $users, ServiceRepository $serviceRepository, CommentRepository $commentRepository): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($lastUsername == null) {
            return $this->redirectToRoute('app_login');
        } else {
            return $this->redirectToRoute('app_admin');
        }
    }
}
