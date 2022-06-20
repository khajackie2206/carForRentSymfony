<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Car;
use App\Entity\Image;
use App\Repository\CarRepository;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Request\CarRequest;
use App\Request\UpdateCarRequest;
use App\Transfer\UpdateCarTransfer;
use Doctrine\ORM\EntityNotFoundException;

class CarService
{
    private CarRepository $carRepository;
    private ImageService $imageService;
    private UserRepository $userRepository;
    private ImageRepository $imageRepository;
    private UpdateCarTransfer $updateCarTransfer;

    public function __construct(
        ImageRepository $imageRepository,
        CarRepository $carRepository,
        UserRepository $userRepository,
        ImageService $imageService,
        UpdateCarTransfer $updateCarTransfer
    ) {
        $this->carRepository = $carRepository;
        $this->imageService = $imageService;
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
        $this->updateCarTransfer = $updateCarTransfer;
    }

    public function findAll(CarRequest $carRequest)
    {
        return $this->carRepository->getAll($carRequest);
    }

    public function getCar(int $id)
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

    public function updateCar(Car $car, UpdateCarRequest $carRequest): Car
    {
         $carUpdate = $this->updateCarTransfer->mapper($car, $carRequest);
         $this->carRepository->save($carUpdate);
         return $car;
    }
}
