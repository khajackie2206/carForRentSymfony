<?php

namespace App\EventListener;
use App\Traits\JsonResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
class AuthenticationFailureListener
{
    use JsonResponseTrait;
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event)
    {
       /* $data = [
            'status' => 'error',
            'message' => 'Unauthorized',
        ];

        $response = new JWTAuthenticationFailureResponse('Bad credentials, please verify that your username/password are correctly set', JsonResponse::HTTP_UNAUTHORIZED);
        $response->setData($data);
        $event->setResponse($response);*/
        $response = $this->error('Unauthorized', JsonResponse::HTTP_UNAUTHORIZED);
        $event->setResponse($response);
    }
}
