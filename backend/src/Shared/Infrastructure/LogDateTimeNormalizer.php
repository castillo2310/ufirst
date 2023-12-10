<?php

namespace ufirst\Shared\Infrastructure;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use ufirst\Log\Domain\LogDateTime;

class LogDateTimeNormalizer implements NormalizerInterface
{
    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        return [
            'day' => $object->format('d'),
            'hour' => $object->format('H'),
            'minute' => $object->format('i'),
            'second' => $object->format('s'),
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof LogDateTime;
    }
}