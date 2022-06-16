<?php

namespace App\Controller\API;;
use App\Repository\CarRepository;
use App\Traits\JsonResponseTrait;
use App\Transformer\CarTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/cars',name: 'app_car_list')]
class CarController extends AbstractController
{
    use JsonResponseTrait;
    #[Route('/', name: 'list_car')]
    public function index(CarRepository $carRepository, CarTransformer $carTransformer): JsonResponse
    {
        $cars = $carRepository->findAll();
        $result = $carTransformer->toArrayList($cars);
        return $this->success($result);
    }
}
