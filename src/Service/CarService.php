<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Car;
use App\Entity\Image;
use App\Mapper\PatchCarRequestToCar;
use App\Mapper\PutCarRequestToCar;
use App\Repository\CarRepository;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Request\CarRequest;
use App\Request\UpdateCarRequest;
use Doctrine\ORM\EntityNotFoundException;

class CarService
{
    private CarRepository $carRepository;
    private ImageService $imageService;
    private UserRepository $userRepository;
    private ImageRepository $imageRepository;
    private PutCarRequestToCar $putCarRequestToCar;
    private PatchCarRequestToCar $patchCarRequestToCar;

    public function __construct(
        ImageRepository      $imageRepository,
        CarRepository        $carRepository,
        UserRepository       $userRepository,
        ImageService         $imageService,
        PutCarRequestToCar   $putCarRequestToCar,
        PatchCarRequestToCar $patchCarRequestToCar
    )
    {
        $this->carRepository = $carRepository;
        $this->imageService = $imageService;
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
        $this->putCarRequestToCar = $putCarRequestToCar;
        $this->patchCarRequestToCar = $patchCarRequestToCar;
    }

    public function findAll(CarRequest $carRequest): array
    {
        return $this->carRepository->getAll($carRequest);
    }

    public function getCar(int $id): Car
    {
        $car = $this->carRepository->find($id);
        if (!$car) {
            throw new EntityNotFoundException('Car id' . $id . 'does not exist!');
        }

        return $car;
    }

    public function addCar(Car $car): Car
    {
        $this->carRepository->save($car);

        return $car;
    }

    public function deleteCar(int $carId): bool
    {
        $car = $this->carRepository->find($carId);
        if (!$car) {
            throw new EntityNotFoundException('Car id' . $carId . 'does not exist!');
        }
        $this->carRepository->remove($car);

        return true;
    }

    public function updatePut(Car $car, UpdateCarRequest $carRequest): Car
    {
        $carUpdate = $this->putCarRequestToCar->mapper($car, $carRequest);
        $this->carRepository->save($carUpdate);

        return $car;
    }

    public function updatePatch(Car $car, UpdateCarRequest $carRequest): Car
    {
        $carUpdate = $this->patchCarRequestToCar->mapper($car, $carRequest);
        $this->carRepository->save($carUpdate);

        return $car;
    }
}
