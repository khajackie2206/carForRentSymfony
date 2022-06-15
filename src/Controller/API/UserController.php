<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'app_api_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'status' => 'success',
            'data' => [
                'message' => 'This is role_user',
            ]
        ]);
    }
}
