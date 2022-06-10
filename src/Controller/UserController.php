<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
class UserController extends AbstractController
{

    public function notifications(): Response
    {
        $userFirstName = 'jackie2206';
        $userNotifications = ['errors' => 'you have 2 errors', 'messages' => 'This is a demo message'];
        return $this->render('user/notifications.html.twig', [
            'user_first_name' => $userFirstName,
            'notifications' => $userNotifications,
        ]);
    }

}