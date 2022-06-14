<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class AdminController extends AbstractController
{
    #[Route('/api/admin', name: 'api_admin')]
    public function index(): Response
    {
        return $this->json( [
            'message' => 'This is role_admin',
        ]);
    }
}
