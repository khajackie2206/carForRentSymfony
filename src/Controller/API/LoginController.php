<?php

namespace App\Controller\API;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Traits\JsonResponseTrait;

class LoginController extends AbstractController
{
    use JsonResponseTrait;

    #[Route('/api/login', name: 'app_api_login')]
    public function login(JWTTokenManagerInterface $tokenManager): JsonResponse
    {
        $user = $this->getUser();
        if ($user === null) {
            $message = 'Unauthorized';
            return $this->error($message, Response::HTTP_UNAUTHORIZED);
        }
        $token = $tokenManager->create($user);
        $data = ['token' => $token];
        return $this->success($data);
    }
}
