<?php

namespace App\Mapper;

use App\Entity\Car;
use App\Entity\User;
use App\Request\UpdateCarRequest;
use Symfony\Component\Security\Core\Security;
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
        $car->setName($updateCarRequest->getName())
            ->setDescription($updateCarRequest->getDescription())
            ->setColor($updateCarRequest->getColor())
            ->setBrand($updateCarRequest->getBrand())
            ->setPrice($updateCarRequest->getPrice())
            ->setSeats($updateCarRequest->getSeats())
            ->setYear($updateCarRequest->getYear())
            ->setCreatedUser($createdUser)
            ->setThumbnail($thumbnail);
        return $car;
    }
}
