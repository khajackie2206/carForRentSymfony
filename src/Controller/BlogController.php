<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     */
    public function list(int $page): Response
    {
        return $this->json([
            'title' => 'This is json content',
            'page' => $page
        ]);
    }

    /**
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function show(string $slug): Response
    {
        return $this->json([
            'title' => 'This is json content',
            'slug' => $slug
        ]);
    }

     #[Route('/redirect', methods: ['GET'])]
    public function redirectTest(): RedirectResponse
    {
        return $this->redirectToRoute('app_blog');
    }
}
