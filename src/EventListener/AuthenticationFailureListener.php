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
        $response = $this->error('Unauthorized', JsonResponse::HTTP_UNAUTHORIZED);
        $event->setResponse($response);
    }
}
