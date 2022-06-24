<?php

namespace App\Controller\API;

use App\Service\MailService;
use Symfony\Component\Routing\Annotation\Route;
use App\Traits\JsonResponseTrait;


class MailController
{
    use JsonResponseTrait;

    #[Route('/api/mail', name: 'send_mail')]
    public function index(MailService $mailService)
    {
        $mailService->sendMail();
        return $this->success([]);
    }
}
