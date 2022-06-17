<?php

namespace App\EventListener;

use App\Traits\JsonResponseTrait;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTNotFoundListener
{
    use JsonResponseTrait;

    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $response = $this->error('Missing token', JsonResponse::HTTP_FORBIDDEN);
        $event->setResponse($response);
    }
}
