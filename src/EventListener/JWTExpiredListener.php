<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use App\Traits\JsonResponseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTExpiredListener
{
    use JsonResponseTrait;

    public function onJWTExpired(JWTExpiredEvent $event)
    {
        $response = $this->error('Your token is invalid', JsonResponse::HTTP_UNAUTHORIZED);
        $event->setResponse($response);
    }
}
