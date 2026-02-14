<?php

declare(strict_types=1);

namespace AssoConnect\AbsolutePercentValueBundle\Normalizer;

use AssoConnect\AbsolutePercentValueBundle\Object\AbsolutePercentValue;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Throwable;

/**
 * Normalizes an instance of {@see AbsolutePercentValue} to an array ['type' => ..., 'value' => ...].
 * Denormalizes an array ['type' => ..., 'value' => ...] to an instance of {@see AbsolutePercentValue}.
 */
class AbsolutePercentValueNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param mixed $data
     * @param mixed[] $context
     * @return mixed[]
     * @throws InvalidArgumentException
     */
    public function normalize(mixed $data, ?string $format = null, array $context = []): array
    {
        if (!$data instanceof AbsolutePercentValue) {
            throw new InvalidArgumentException(sprintf(
                'The object must be an instance of "%s".',
                AbsolutePercentValue::class
            ));
        }

        return [
            'type' => $data->getType(),
            'value' => $data->getValue()
        ];
    }

    /**
     * @param mixed $data
     * @param array<mixed> $context
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof AbsolutePercentValue;
    }

    public function denormalize(
        mixed $data,
        string $type,
        ?string $format = null,
        array $context = []
    ): mixed {
        if ('' === $data || null === $data) {
            throw new UnexpectedValueException();
        }

        try {
            return new AbsolutePercentValue($data['type'], $data['value']);
        } catch (Throwable $e) {
            throw new UnexpectedValueException(previous: $e);
        }
    }

    /**
     * @param mixed $data
     * @param array<mixed> $context
     */
    public function supportsDenormalization(
        mixed $data,
        string $type,
        ?string $format = null,
        array $context = []
    ): bool {
        return $type === AbsolutePercentValue::class;
    }

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [AbsolutePercentValue::class => true];
    }
}
