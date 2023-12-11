<?php

namespace ufirst\Log\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use ufirst\Log\Application\GetLog\GetLogService;

#[Route('/log', name: 'log_get', methods: ['GET'])]
final class GetLogController extends AbstractController
{
    public function __construct(private readonly GetLogService $getLogService)
    {
    }

    public function __invoke(): Response
    {
        $data = $this->getLogService->__invoke();

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}