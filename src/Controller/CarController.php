<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/add', name: 'app_create_car')]
    public function createCar(Request $request): Response
    {
        $car = new Car();
        $form = $this->createForm(CarForm::class, $car);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('car/index.html.twig', [
              'form' => $form->createView()
            ]);
        }
        return $this->redirect('app_car');
    }
}
