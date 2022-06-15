<?php

namespace App\EventListener;
use App\Traits\JsonResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTInvalidListener
{
    use JsonResponseTrait;
    public function onJWTInvalid(JWTInvalidEvent $event)
    {
        $response = $this->error('Your token is invalid', JsonResponse::HTTP_UNAUTHORIZED);
        $event->setResponse($response);
    }

}
