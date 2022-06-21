<?php

namespace App\Controller\API;

use App\Service\ImageService;
use App\Traits\JsonResponseTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImageController extends AbstractController
{
    use JsonResponseTrait;

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: "You are not allowed to enter!!!")]
    #[Route('api/cars/upload', name: 'app_file_upload', methods: 'POST')]
    public function uploadImage(ImageService $imageService, Request $request): JsonResponse
    {
        $file = $request->files->get('thumbnail');
        $image = $imageService->upload($file);
        return $this->success([], Response::HTTP_OK);
    }
}
