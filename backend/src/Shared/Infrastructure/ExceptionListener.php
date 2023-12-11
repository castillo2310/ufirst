<?php

namespace ufirst\Shared\Infrastructure;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener(event: 'kernel.exception')]
final readonly class ExceptionListener
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $this->logger->error($exception->getMessage());

        $response = new JsonResponse(
            [
                'message' => $exception->getMessage()
            ],
            Response::HTTP_BAD_REQUEST
        );
        $event->setResponse($response);
    }
}