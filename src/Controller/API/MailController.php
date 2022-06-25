<?php

namespace App\Controller\API;

use App\Service\MailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Traits\JsonResponseTrait;


class MailController
{
    use JsonResponseTrait;

    #[Route('/api/mail', name: 'send_mail', methods: ['POST'])]
    public function index(MailService $mailService, Request $request)
    {
        $mailRequest = json_decode($request->getContent(), true);
        $targetAddress = $mailRequest['targetAddress'];
        $targetName = $mailRequest['targetName'];
        $mailService->sendMail($targetAddress, $targetName);
        return $this->success([
            'message' => 'Send mail successfully !'
        ]);
    }
}
