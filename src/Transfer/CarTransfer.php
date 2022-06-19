<?php

namespace App\Transfer;

use App\Entity\Car;
use Symfony\Component\HttpFoundation\Request;

class CarTransfer
{
    public function transfer(Request $request): Car
    {
        $car = new Car();
        $car->setName($request->get('name'));
        $car->setDescription($request->get('description'));
        $car->setColor($request->get('color'));
        $car->setBrand($request->get('brand'));
        $car->setSeats($request->get('seat'));
        $car->setYear($request->get('year'));
        $car->setPrice($request->get('price'));
        return $car;
    }

}