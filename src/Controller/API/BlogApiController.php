<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogApiController extends AbstractController
{
    #[Route('/api/random/{id}', methods: ['GET', 'HEAD'])]
    public function show(int $id): Response
    {
        return $this->json([
             'id_random' => $id,
             'title' => 'Kha jackie 2206',
        ]);
    }
}
