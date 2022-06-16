<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Traits\JsonResponseTrait;
class ProfileController extends AbstractController
{
    use JsonResponseTrait;
    #[Route('/api/user', name: 'app_api_user')]
    public function index(): JsonResponse
    {
        return $this->success(['message' => 'This is role User']);
    }
}
