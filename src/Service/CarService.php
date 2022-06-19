<?php

namespace App\Service;

use App\Entity\Car;
use App\Entity\Image;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use App\Request\CarRequest;
use Doctrine\ORM\EntityNotFoundException;

class CarService
{
    private CarRepository $carRepository;
    private ImageService $imageService;
    private UserRepository $userRepository;

    public function __construct(CarRepository $carRepository, UserRepository $userRepository, ImageService $imageService)
    {
        $this->carRepository = $carRepository;
        $this->imageService = $imageService;
        $this->userRepository = $userRepository;
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

    public function addCar(int $userID, string $imagePath, Car $car): Car
    {
        $user = $this->userRepository->find($userID);
        $image = new Image();
        $image->setPath($imagePath);
        $car->setThumbnail($image);
        $car->setCreatedUser($user);
        $this->imageService->addImage($image);
        $this->carRepository->save($car);
        return $car;
    }
}
