<?php

namespace ufirst\Log\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use ufirst\Log\Application\UploadFile\UploadFileDTO;
use ufirst\Log\Application\UploadFile\UploadFileService;

#[Route('/log', name: 'log_file_upload', methods: ['PUT'])]
final class UploadFileController extends AbstractController
{
    public function __construct(private readonly UploadFileService $uploadFileService)
    {
    }

    public function __invoke(
        #[MapRequestPayload] UploadFileDTO $uploadFileDTO
    ): JsonResponse
    {
        $this->uploadFileService->__invoke($uploadFileDTO);

        return $this->json([], Response::HTTP_OK);
    }
}