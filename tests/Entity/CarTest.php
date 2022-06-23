<?php

namespace App\Tests\Entity;

use App\Entity\Car;
use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Image;

class CarTest extends TestCase
{
    public function testGetSetCar()
    {
        $paramsCar = [
            'ID' => 1,
            'name' => 'kia',
            'description' => 'this is the fastest car in the world!!',
            'color' => 'black',
            'brand' => 'kia',
            'price' => 5000,
            'seats' => 4,
            'year' => 2022,
        ];
        $car = new Car();
        $car->setBrand($paramsCar['brand']);
        $car->setColor($paramsCar['color']);
        $car->setCreatedAt(new \DateTimeImmutable());
        $car->setPrice($paramsCar['price']);
        $car->setSeats($paramsCar['seats']);
        $car->setYear($paramsCar['year']);
        $car->setName($paramsCar['name']);
        $car->setDescription($paramsCar['description']);
        $this->assertEquals($car->getBrand(), $paramsCar['brand']);
        $this->assertEquals($car->getName(), $paramsCar['name']);
        $this->assertEquals($car->getColor(), $paramsCar['color']);
        $this->assertEquals($car->getPrice(), $paramsCar['price']);
    }
}
