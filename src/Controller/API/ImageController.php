<?php

namespace App\Controller\API;

use App\Request\ImageRequest;
use App\Service\ImageService;
use App\Traits\JsonResponseTrait;
use App\Transformer\ImageTransformer;
use App\Transformer\ValidatorTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ImageController extends AbstractController
{
    use JsonResponseTrait;

    private ValidatorTransformer $validatorTransformer;

    public function __construct(ValidatorTransformer $validatorTransformer)
    {
        $this->validatorTransformer = $validatorTransformer;
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403, message: "You are not allowed to enter!!!")]
    #[Route('api/cars/upload', name: 'app_file_upload', methods: 'POST')]
    public function uploadImage(
        ImageService $imageService,
        ImageRequest $imageRequest,
        Request $request,
        ImageTransformer $imageTransformer,
        ValidatorInterface $validator
    ): JsonResponse {
        $file = $request->files->get('thumbnail');
        $imageRequest = $imageRequest->setImage($file);
        $errors = $validator->validate($imageRequest);
        if (count($errors) > 0) {
            $errorsTransformer = $this->validatorTransformer->toArray($errors);
            return $this->error($errorsTransformer);
        }
        $image = $imageService->upload($file);
        $result = $imageTransformer->toArray($image);

        return $this->success($result);
    }
}
