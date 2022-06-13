<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Car;
use App\Form\AddCarType;
use App\Repository\CarRepository;
use App\Service\CarService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
#[Route('/cars', name: 'app_car')]
class CarController extends AbstractController
{
    private CarRepository $carRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CarService $carService, CarRepository $carRepository, EntityManagerInterface $entityManager)
    {
       $this->carRepository = $carRepository;
       $this->entityManager = $entityManager;
    }

    #[Route('/new', name: 'create_car')]
    public function createProduct(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $brand = new Brand();
        $brand->setBrand('normal car');
        $car = new Car();
        $car->setName('g63');
        $car->setPrice(1400);
        $car->setThumb('https://khajackie2206.s3.ap-southeast-1.amazonaws.com/6e47636c53b2a0f639eb9c94a8b9a7f3g63.jpg');
        // relates this product to the category
        $car->setDescription('this car is so expensive');
        $car->setBrand($brand);
        $entityManager->persist($brand);
        $entityManager->persist($car);
        $entityManager->flush();
        return new Response(
            'Saved new product with id: ' . $car->getId()
            . ' and new category with id: ' . $brand->getId()
        );
    }

    #[Route('/', name: 'show_car')]
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $cars = $doctrine->getRepository(Car::class)->findAll();
        return $this->render('car/index.html.twig',[
            'cars' => $cars
        ]);
    }

    #[Route('/add', name: 'app_create_car', methods: ['GET', 'POST'])]
    public function createCar(Request $request): Response
    {
        $car = new Car();
        $form = $this->createForm(AddCarType::class, $car);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->renderForm('car/create.html.twig', [
                'form' => $form
            ]);
        }
        return $this->redirectToRoute('app_car');
    }
}
