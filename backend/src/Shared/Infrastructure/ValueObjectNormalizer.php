<?php

namespace ufirst\Shared\Infrastructure;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use ufirst\Shared\Domain\ValueObject;

class ValueObjectNormalizer implements NormalizerInterface
{
    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        return $object->getValue();
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof ValueObject;
    }
}