<?php

namespace App\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class JWTExpiredListener
{
    /**
     * @param JWTExpiredEvent $event
     */
    public function onJWTExpired(JWTExpiredEvent $event)
    {
        /** @var JWTAuthenticationFailureResponse */
        $response = $event->getResponse();
        $response->setMessage('Your token is expired, please renew it.');
    }
}
