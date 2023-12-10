<?php

namespace ufirst\Shared\Infrastructure;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use ufirst\Shared\Domain\JsonSerializer;

class JsonSerializerSymfonyAdapter implements JsonSerializer
{
    private SerializerInterface $serializer;

    public function __construct()
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $this->serializer = new Serializer([
            new ValueObjectNormalizer(),
            new LogDateTimeNormalizer(),
            new BackedEnumNormalizer(),
            $normalizer
        ], [new JsonEncoder()]);
    }

    public function serialize(mixed $data): string
    {
        return $this->serializer->serialize($data, 'json', ['json_encode_options' => JSON_UNESCAPED_SLASHES]);
    }
}