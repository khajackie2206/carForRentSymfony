<?php

namespace App\Controller\API;

use App\Entity\Car;
use App\Mapper\AddCarRequestToCar;
use App\Request\AddCarRequest;
use App\Request\CarRequest;
use App\Request\UpdateCarRequest;
use App\Service\CarService;
use App\Traits\JsonResponseTrait;
use App\Transformer\ValidatorTransformer;
use Symfony\Component\HttpFoundation\Response;
use App\Transformer\CarTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/api/cars', name: 'app_car_list')]
class CarController extends AbstractController
{
    use JsonResponseTrait;

    const FORBIDDEN_REQUEST_MESSAGE = "You are not allowed to enter!";

    #[Route('/', name: 'list_car', methods: 'GET')]
    public function index(
        Request              $request,
        CarRequest           $carRequest,
        ValidatorInterface   $validator,
        CarTransformer       $carTransformer,
        ValidatorTransformer $validatorTransformer,
        CarService           $carService
    ): JsonResponse
    {
        $query = $request->query->all();
        $carRequest = $carRequest->fromArray($query);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            $errorsTransformer = $validatorTransformer->toArray($errors);
            return $this->error($errorsTransformer);
        }
        $cars = $carService->findAll($carRequest);
        $result = $carTransformer->toArrayList($cars);

        return $this->success($result);
    }

    #[Route('/{id}', name: 'car_detail', methods: 'GET')]
    public function carDetails(Car $car, CarTransformer $carTransformer): JsonResponse
    {
        return $this->success($carTransformer->fromArray($car));
    }

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/', name: 'add_car', methods: 'POST')]
    public function addCar(
        Request              $request,
        CarService           $carService,
        AddCarRequest        $addCarRequest,
        CarTransformer       $carTransformer,
        AddCarRequestToCar   $addCarRequestToCar,
        ValidatorTransformer $validatorTransformer,
        ValidatorInterface   $validator
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $carRequest = $addCarRequest->fromArray($requestBody);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            $errorsTransformer = $validatorTransformer->toArray($errors);
            return $this->error($errorsTransformer);
        }
        $car = $addCarRequestToCar->transfer($carRequest);
        $result = $carTransformer->fromArray($carService->addCar($car));

        return $this->success($result, Response::HTTP_CREATED);
    }

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/{id}', name: 'update_car_put', methods: ['PUT'])]
    public function updatePut(
        Car                  $car,
        Request              $request,
        CarService           $carService,
        UpdateCarRequest     $updateCarRequest,
        CarTransformer       $carTransformer,
        ValidatorInterface   $validator,
        ValidatorTransformer $validatorTransformer
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $carRequest = $updateCarRequest->fromArray($requestBody);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            $errorsTransformer = $validatorTransformer->toArray($errors);
            return $this->error($errorsTransformer);
        }
        $car = $carService->updatePut($car, $carRequest);
        $result = $carTransformer->fromArray($car);

        return $this->success($result);
    }

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/{id}', name: 'update_car_patch', methods: ['PATCH'])]
    public function updatePatch(
        Car                  $car,
        Request              $request,
        CarService           $carService,
        UpdateCarRequest     $updateCarRequest,
        CarTransformer       $carTransformer,
        ValidatorInterface   $validator,
        ValidatorTransformer $validatorTransformer
    ): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $carRequest = $updateCarRequest->fromArray($requestBody);
        $errors = $validator->validate($carRequest);
        if (count($errors) > 0) {
            $errorsTransformer = $validatorTransformer->toArray($errors);
            return $this->error($errorsTransformer);
        }
        $car = $carService->updatePatch($car, $carRequest);
        $result = $carTransformer->fromArray($car);

        return $this->success($result);
    }

    #[IsGranted('ROLE_ADMIN', message: self::FORBIDDEN_REQUEST_MESSAGE, statusCode: Response::HTTP_FORBIDDEN)]
    #[Route('/{id}', name: 'remove_car', methods: 'DELETE')]
    public function removeCar(int $id, CarService $carService): JsonResponse
    {
        $result = $carService->deleteCar($id);
        if ($result) {
            return $this->success([], Response::HTTP_NO_CONTENT);
        }

        return $this->error(Response::HTTP_BAD_REQUEST);
    }
}
