<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    public function show(): Response
    {
        return $this->render('notfound/error404.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }
}
