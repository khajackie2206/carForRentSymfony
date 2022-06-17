<?php

namespace App\Controller\API;
use App\Request\CarRequest;
use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/cars', name: 'app_car_list')]
class CarController extends AbstractController
{
    use JsonResponseTrait;

    #[Route('/', name: 'list_car')]
    public function index(
        Request            $request,
        CarRequest         $carRequest,
        ValidatorInterface $validator,
        CarTransformer     $carTransformer,
        CarService         $carService
    ): JsonResponse
    {
        $query = $request->query->all();
        $carRequest = $carRequest->fromArray($query);
        $validator->validate($carRequest);
        $cars = $carService->findAll($carRequest);
        $result = $carTransformer->toArrayList($cars);

        return $this->success($result);
    }
}
