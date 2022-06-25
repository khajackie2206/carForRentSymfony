<?php

namespace App\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailService
{
    private ContainerBagInterface $params;

    public function __construct(ContainerBagInterface $params)
    {
        $this->params = $params;
    }

    public function sendMail(string $targetAddress, string $targetName)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = $this->params->get('zohoHost');
            $mail->SMTPAuth = true;
            $mail->Username = $this->params->get('zohoMail');
            $mail->Password = $this->params->get('zohoPassword');
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($this->params->get('zohoMail'), 'Kha Support');
            $mail->addAddress($targetAddress, $targetName);

            $mail->isHTML(true);
            $mail->Subject = 'Hi ' . $targetName;
            $mail->Body = file_get_contents($this->params->get('templateMail'));
            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}
