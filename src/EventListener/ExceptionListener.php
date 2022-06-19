<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Throwable;
use App\Traits\JsonResponseTrait;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

class ExceptionListener
{
    use JsonResponseTrait;

    const BAD_REQUEST = 'Bad request';
    const UNAUTHORIZED = 'Unauthorized';
    const DEFAULT_ERROR_MESSAGE = 'Something wrong.';
    const DEV_ENV = 'dev';

    private string $environment;
    private ?Request $request;
    private Environment $twig;

    public function __construct(KernelInterface $kernel, RequestStack $requestStack, Environment $twig)
    {
        $this->twig = $twig;
        $this->environment = $kernel->getEnvironment();
        $this->request = $requestStack->getCurrentRequest();
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        [$statusCode, $message] = $this->getStatusCodeAndMessage($exception);
        $response = $this->error($message, $statusCode);
        $event->setResponse($response);
    }

    private function getStatusCodeAndMessage(Throwable $exception): array
    {
        $exceptionClass = get_class($exception);
        $message = $this->isDevEnvironment() ? $exception->getMessage() : static::DEFAULT_ERROR_MESSAGE;
        switch ($exceptionClass) {
            case HttpExceptionInterface::class:
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
            case NotFoundHttpException::class:
                $statusCode = Response::HTTP_NOT_FOUND;
                break;
            case ValidatorException::class:
                $message = self::BAD_REQUEST;
                $statusCode = Response::HTTP_BAD_REQUEST;
                break;
            case UnauthorizedHttpException::class:
                $message = self::UNAUTHORIZED;
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;
            default:
                $statusCode = Response::HTTP_BAD_REQUEST;
        }

        return [$statusCode, $message];
    }

    private function isDevEnvironment(): bool
    {
        return $this->environment === static::DEV_ENV;
    }

}
