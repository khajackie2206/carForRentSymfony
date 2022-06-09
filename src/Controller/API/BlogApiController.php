<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogApiController extends AbstractController
{
    #[Route('/a/p/i/blog/api', name: 'app_a_p_i_blog_api')]
    public function index(): Response
    {
        return $this->render('api/blog_api/index.html.twig', [
            'controller_name' => 'BlogApiController',
        ]);
    }
}
