<?php

namespace App\Controller\API;

use App\Entity\Car;
use App\Request\CarRequest;
use App\Service\CarService;
use App\Service\UploadFileService;
use App\Traits\JsonResponseTrait;
use App\Transfer\CarTransfer;
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

    #[Route('/', name: 'list_car', methods: 'GET')]
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

    #[Route('/{id}', name: 'car_detail', methods: 'GET')]
    public function carDetails(Car $car, CarTransformer $carTransformer)
    {
        return $this->success($carTransformer->fromArray($car));
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'add_car', methods: 'POST')]
    public function addCar(
        Request           $request,
        CarService        $carService,
        CarTransformer    $carTransformer,
        UploadFileService $uploadFileService,
        CarTransfer       $carTransfer
    )
    {
        $userID = $this->getUser()->getID();
        $car = $carTransfer->transfer($request);
        $file = $request->files->get('thumbnail');
        $imagePath = $uploadFileService->upload($file);
        $carService->addCar($userID, $imagePath, $car);
        $result = $carTransformer->fromArray($car);
        return $this->success($result);
    }
}
