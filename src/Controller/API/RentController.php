<?php

namespace App\Controller\API;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class RentController
{
    #[Route('/rents', name: 'app_rent_cars', methods: 'POST')]
    public function rentCar(Request $request, )
    {
        $rentRequest = $request->query->all();
    }
}
