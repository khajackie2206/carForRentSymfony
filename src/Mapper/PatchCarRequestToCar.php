<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Entity\User;
use App\Request\UpdateCarRequest;
use Symfony\Component\Security\Core\Security;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;

class PatchCarRequestToCar
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

        $createdUserId = $updateCarRequest->getCreatedUser();
        if ($createdUserId != null) {
            $createdUser = $this->userRepository->find($createdUserId);
            $car->setCreatedUser($createdUser);
        }
        $thumbnailId = $updateCarRequest->getThumbnail();
        if ($thumbnailId != null) {
            $thumbnail = $this->imageRepository->find($thumbnailId);
            $car->setThumbnail($thumbnail);
        }
        $car->setName($updateCarRequest->getName() ?? $car->getName());
        $car->setDescription($updateCarRequest->getDescription() ?? $car->getDescription());
        $car->setColor($updateCarRequest->getColor() ?? $car->getColor());
        $car->setBrand($updateCarRequest->getBrand() ?? $car->getBrand());
        $car->setPrice($updateCarRequest->getPrice() ?? $car->getPrice());
        $car->setSeats($updateCarRequest->getSeats() ?? $car->getSeats());
        $car->setYear($updateCarRequest->getYear() ?? $car->getYear());

        return $car;
    }
}
