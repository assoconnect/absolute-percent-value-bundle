<?php

declare(strict_types=1);

namespace AssoConnect\AbsolutePercentValueBundle\Normalizer;

use AssoConnect\AbsolutePercentValueBundle\Object\AbsolutePercentValue;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizes an instance of {@see AbsolutePercentValue} to an array ['type' => ..., 'value' => ...].
 * Denormalizes an array ['type' => ..., 'value' => ...] to an instance of {@see AbsolutePercentValue}.
 */
class AbsolutePercentValueNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param mixed $object
     * @param mixed[] $context
     * @return mixed[]
     * @throws InvalidArgumentException
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        if (!$object instanceof AbsolutePercentValue) {
            throw new InvalidArgumentException(sprintf(
                'The object must be an instance of "%s".',
                AbsolutePercentValue::class
            ));
        }

        return [
            'type' => $object->getType(),
            'value' => $object->getValue()
        ];
    }

    /**
     * @param mixed $data
     * @param array<mixed> $context
     */
    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof AbsolutePercentValue;
    }

    /**
     * @param mixed $data
     * @param array<mixed> $context
     *
     * @throws NotNormalizableValueException
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?AbsolutePercentValue
    {
        try {
            if ('' === $data || null === $data) {
                return null;
            }
            return  new AbsolutePercentValue($data['type'], $data['value']);
        } catch (\Exception $e) {
            throw new NotNormalizableValueException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param mixed $data
     * @param array<mixed> $context
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return $type === AbsolutePercentValue::class;
    }
}
