<?php

namespace ufirst\Log\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use ufirst\Log\Application\CreateLog\CreateLogDTO;
use ufirst\Log\Application\CreateLog\CreateLogService;


#[Route('/log', name: 'log_file_upload', methods: ['PUT'])]
final class CreateLogController extends AbstractController
{
    public function __construct(private readonly CreateLogService $createLogService)
    {
    }

    public function __invoke(
        #[MapRequestPayload] CreateLogDTO $createLogDTO
    ): JsonResponse
    {
        $this->createLogService->__invoke($createLogDTO);

        return $this->json([], Response::HTTP_OK);
    }
}