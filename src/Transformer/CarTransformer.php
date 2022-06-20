<?php

namespace App\Transformer;

use App\Entity\Car;

class CarTransformer
{
    public function fromArray(Car $car): array
    {
        return [
            'id' => $car->getId(),
            'name' => $car->getName(),
            'description' => $car->getDescription(),
            'color' => $car->getColor(),
            'brand' => $car->getBrand(),
            'price' => $car->getPrice(),
            'seats' => $car->getSeats(),
            'year' => $car->getYear(),
            'thumbnail' => $car->getThumbnail()->getId(),
            'createdUser' => $car->getCreatedUser()->getId()
        ];
    }

    public function toArrayList(array $cars): array
    {
        $result = [];
        foreach ($cars as $car) {
            $result[] = $this->fromArray($car);
        }

        return $result;
    }
}
