<?php

namespace App\Service;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Request\CarRequest;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function findAll(CarRequest $carRequest)
    {
        return $this->carRepository->getAll($carRequest);
    }
}
