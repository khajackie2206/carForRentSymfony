<?php

namespace App\Tests\Service;

use App\Entity\Car;
use App\Mapper\PatchCarRequestToCar;
use App\Mapper\PutCarRequestToCar;
use App\Repository\CarRepository;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Request\CarRequest;
use App\Service\CarService;
use App\Service\ImageService;
use PHPUnit\Framework\TestCase;

class CarServiceTest extends TestCase
{
    public function testFindAll()
    {
        $carRequest = new CarRequest();
        $carRequest->setColor('black');
        $carRequest->setBrand('kia');
        $carRequest->setOrderType('price');
        $carRequest->setOrderBy('asc');
        $carRepositoryMock = $this->getMockBuilder(CarRepository::class)->disableOriginalConstructor()->getMock();
        $carRepositoryMock->expects($this->once())->method('getAll')->willReturn(array());
        $putCarRequestToCarMock = $this->getMockBuilder(PutCarRequestToCar::class)->disableOriginalConstructor()->getMock();
        $patchCarRequestToCar = $this->getMockBuilder(PatchCarRequestToCar::class)->disableOriginalConstructor()->getMock();
        $carService = new CarService($carRepositoryMock, $putCarRequestToCarMock, $patchCarRequestToCar);
        $carList = $carService->findAll($carRequest);
        $this->assertIsArray($carList);
    }

    public function testGetCar()
    {
        $car = new Car();
        $carRepositoryMock = $this->getMockBuilder(CarRepository::class)->disableOriginalConstructor()->getMock();
        $carRepositoryMock->expects($this->once())->method('find')->willReturn($car);
        $putCarRequestToCarMock = $this->getMockBuilder(PutCarRequestToCar::class)->disableOriginalConstructor()->getMock();
        $patchCarRequestToCar = $this->getMockBuilder(PatchCarRequestToCar::class)->disableOriginalConstructor()->getMock();
        $carService = new CarService($carRepositoryMock, $putCarRequestToCarMock, $patchCarRequestToCar);
        $carResult = $carService->getCar('1');
        $this->assertNotNull($carResult);
    }
}
