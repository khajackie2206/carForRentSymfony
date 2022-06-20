<?php

namespace App\Transfer;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use App\Entity\Car;
use App\Repository\ImageRepository;
use App\Request\AddCarRequest;

class CarTransfer
{
    private ImageRepository $imageRepository;
    private Security $security;

    public function __construct(ImageRepository $imageRepository, Security $security)
    {
        $this->imageRepository = $imageRepository;
        $this->security = $security;
    }

    public function transfer(AddCarRequest $addCarRequest): Car
    {
        /**
         * @var User $user ;
         */
        $user = $this->security->getUser();
        $car = new Car();
        $car->setName($addCarRequest->getName());
        $car->setDescription($addCarRequest->getDescription());
        $car->setColor($addCarRequest->getColor());
        $car->setBrand($addCarRequest->getBrand());
        $car->setSeats($addCarRequest->getSeats());
        $car->setYear($addCarRequest->getYear());
        $car->setPrice($addCarRequest->getPrice());
        $car->setCreatedUser($user);
        $car->setThumbnail($this->imageRepository->find($addCarRequest->getThumbnail()));
        return $car;
    }
}
