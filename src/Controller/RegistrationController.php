<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\JWTService;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/inscription')]
class RegistrationController extends AbstractController
{

    public function __construct( private readonly UserRepository $userRepository )  {  }

    #[Route('/', name: 'app_veto_register')]
    public function register(Request $request,JWTService $jwt, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager, SendMailService $mail): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_VETERINAIRE']);
            $entityManager->persist($user);
            $entityManager->flush();

            // we generate the user's JWT
            // we create the Header
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            // we create the Payload
            $payload = [
                'user_id' => $user->getId()
            ];

            // we generate the token
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

            // send mail
            $mail->send(
                'no-reply@monsite.net',
                $user->getEmail(),
                'Activation de votre compte sur le site e-commerce',
                'register',
                compact('user', 'token')
            );
            $this->addFlash('success', 'Le compte a bien été crée');

            return $this->redirectToRoute('app_user_index');
            //return $security->login($user, 'form_login', 'main');
        }

        return $this->render('admin/user/register.html.twig', [
            'role' => 'Vétérinaire',
            'registrationForm' => $form,
        ]);
    }

    #[Route('/emp', name: 'app_emp_register')]
    public function registerEmp(Request $request,JWTService $jwt, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager, SendMailService $mail): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_EMPLOYE']);
            $entityManager->persist($user);
            $entityManager->flush();

            // we generate the user's JWT
            // we create the Header
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            // // we create the Payload
            $payload = [
                'user_id' => $user->getId()
            ];

            // we generate the token
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

            // send mail
            $mail->send(
                'no-reply@monsite.net',
                $user->getEmail(),
                'Activation de votre compte sur le site e-commerce',
                'register',
                compact('user', 'token')
            );
            $this->addFlash('success', 'Le compte a bien été créé');

            return $this->redirectToRoute('app_user_index');
            //return $security->login($user, 'form_login', 'main');
        }

        return $this->render('admin/user/register.html.twig', [
            'role' => 'Employé(e)',
            'registrationForm' => $form,
        ]);
    }
    #[Route('/verif/{token}', name: 'verify_user')]
    public function verifyUser($token, JWTService $jwt, UserRepository $usersRepository, EntityManagerInterface $em): Response
    {
        // we check if the token is valid, has not expired and has not been modified
        if($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, $this->getParameter('app.jwtsecret'))){
            // we recover the payload
            $payload = $jwt->getPayload($token);

            // we recover the user of the token
            $user = $usersRepository->find($payload['user_id']);

            // we check that the user exists and has not yet activated their account
            if($user && !$user->getIsVerified()){
                $user->setIsVerified(true);
                $em->flush($user);
                $this->addFlash('success', 'Utilisateur activé');
                return $this->redirectToRoute('app_main');
            }
        }
        // here a problem arises in the token
        $this->addFlash('danger', 'Le token est invalide ou a expiré');
        return $this->redirectToRoute('app_login');
    }
    #[Route('/renvoiverif', name: 'resend_verif')]
    public function resendVerif(JWTService $jwt, SendMailService $mail, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        if(!$user){
            $this->addFlash('danger', 'Vous devez être connecté pour accéder à cette page');
            return $this->redirectToRoute('app_login');
        }

        if($user->getIsVerified()){
            $this->addFlash('warning', 'Cet utilisateur est déjà activé');
            return $this->redirectToRoute('app_main');
        }

        // we generate the user's JWT
        // we create the Header
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        // we create the Payload
        $payload = [
            'user_id' => $user->getId()
        ];

        // we generate the token
        $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));

        // send mail
        $mail->send(
            'no-reply@monsite.net',
            $user->getEmail(),
            'Activation de votre compte sur le site Arcadia zoo',
            'register',
            compact('user', 'token')
        );
        $this->addFlash('success', 'Email de vérification envoyé');
        return $this->redirectToRoute('app_user');
    }

}
