<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Request\UpdateCarRequest;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;

class PutCarRequestToCar
{
    private ImageRepository $imageRepository;
    private UserRepository $userRepository;

    public function __construct(ImageRepository $imageRepository, UserRepository $userRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->userRepository = $userRepository;
    }

    public function mapper(Car $car, UpdateCarRequest $updateCarRequest): Car
    {
        $createdUser = $this->userRepository->find($updateCarRequest->getCreatedUser());
        $thumbnail = $this->imageRepository->find($updateCarRequest->getThumbnail());
        $car->setName($updateCarRequest->getName());
        $car->setDescription($updateCarRequest->getDescription());
        $car->setColor($updateCarRequest->getColor());
        $car->setBrand($updateCarRequest->getBrand());
        $car->setPrice($updateCarRequest->getPrice());
        $car->setSeats($updateCarRequest->getSeats());
        $car->setYear($updateCarRequest->getYear());
        $car->setCreatedUser($createdUser);
        $car->setThumbnail($thumbnail);

        return $car;
    }
}
