<?php

namespace App\Controller\API;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(JWTTokenManagerInterface $tokenManager): JsonResponse
    {
        $user = $this->getUser();
        if ($user === null) {
            return $this->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $token = $tokenManager->create($user);
        return $this->json([
            'status' => 'success',
            'data' => [
                'user' => $user->getUserIdentifier(),
                'roles' => $user->getRoles(),
                'token' => $token
            ],
        ]);
    }
}
