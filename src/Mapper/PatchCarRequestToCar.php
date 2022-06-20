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

        $createdUserID = $updateCarRequest->getCreatedUser();
        if ($createdUserID != null) {
            $createdUser = $this->userRepository->find($createdUserID);
            $car->setCreatedUser($createdUser);
        }
        $thumbnailID = $updateCarRequest->getThumbnail();
        if ($thumbnailID != null) {
            $thumbnail = $this->imageRepository->find($thumbnailID);
            $car->setThumbnail($thumbnail);
        }
        $car->setName($updateCarRequest->getName() ?? $car->getName())
            ->setDescription($updateCarRequest->getDescription() ?? $car->getDescription())
            ->setColor($updateCarRequest->getColor() ?? $car->getColor())
            ->setBrand($updateCarRequest->getBrand() ?? $car->getBrand())
            ->setPrice($updateCarRequest->getPrice() ?? $car->getPrice())
            ->setSeats($updateCarRequest->getSeats() ?? $car->getSeats())
            ->setYear($updateCarRequest->getYear() ?? $car->getYear());

        return $car;
    }
}
