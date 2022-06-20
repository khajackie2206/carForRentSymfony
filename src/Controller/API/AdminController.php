<?php

namespace App\Controller\API;

use App\Traits\JsonResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    use JsonResponseTrait;

    #[Route('/api/admin', name: 'app_api_admin')]
    public function index(): JsonResponse
    {
        return $this->success(['message' => 'This is Admin Role']);
    }
}
