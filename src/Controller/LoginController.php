<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('profile');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/login_success', name: 'login_success')]
    public function handleRole()
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        }
        return $this->redirectToRoute('profile');
    }

    #[Route('/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): void
    {
        throw new \Exception('Do not forget to activate logout in security.yaml');
    }
}
