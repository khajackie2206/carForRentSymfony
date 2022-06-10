<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
class ProductController extends AbstractController
{
    #[Route('/product/add', name: 'create_product')]
    public function createProduct(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $product = new Product();
        $product->setName('g63');
        $product->setPrice(1300);
        $product->setThumb('https://khajackie2206.s3.ap-southeast-1.amazonaws.com/6e47636c53b2a0f639eb9c94a8b9a7f3g63.jpg');
        $entityManager->persist($product);
        $entityManager->flush();
        return new Response('Save the new car with id '.$product->getId());
    }


     #[Route("/product/{id}", name: "product_show",requirements: ['id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, int $id)
    {
        $cars = $doctrine->getRepository(Product::class)->find($id);
        if (!$cars){
            return $this->render('notfound/error404.html.twig');
        }
       return $this->render('product/index.html.twig',[
           'cars' => $cars
        ]) ;
    }

     #[Route("/product", name: "product_show_all")]
    public function showAll(ManagerRegistry $doctrine): Response
    {
        $cars = $doctrine->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig',[
            'cars' => $cars
        ]) ;
    }

    #[Route("/product/price/{price}", name: "product_search_by_price",requirements: ['price' => '\d+'])]
    public function showPrice(ManagerRegistry $doctrine, int $price)
    {
        $cars = $doctrine->getRepository(Product::class)->findAllGreaterThanPrice($price);
        if (!$cars){
            return $this->render('notfound/error404.html.twig');
        }
        return $this->render('product/index.html.twig',[
            'cars' => $cars
        ]) ;
    }

}
