<?php

namespace App\Transformer;

use App\Entity\Rent;

class RentTransformer
{
    public function toArray(Rent $rent): array
    {
        return [
            'id' => $rent->getId(),
            'carID' => $rent->getCar(),
            'userID' => $rent->getUser(),
            'status' => $rent->getStatus(),
            'startDate' => $rent->getStartDate(),
            'endDate' => $rent->getEndDate()
        ];
    }

}
