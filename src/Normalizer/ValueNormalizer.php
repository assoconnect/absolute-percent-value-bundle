<?php

declare(strict_types=1);

namespace AssoConnect\AbsolutePercentValueBundle\Normalizer;

use AssoConnect\AbsolutePercentValueBundle\Object\Value;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizes an instance of {@see Value} to an array ['type' => ..., 'value' => ...].
 * Denormalizes an array ['type' => ..., 'value' => ...] to an instance of {@see Value}.
 */
class ValueNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private static $supportedTypes = [
        Value::class => true,
    ];

    public function __construct(array $defaultContext = [])
    {
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        if (!$object instanceof Value) {
            throw new InvalidArgumentException(sprintf(
                'The object must be an instance of "%s".',
                Value::class
            ));
        }

        return [
            'type' => $object->getType(),
            'value' => preg_replace('/\s+/', '', $object->getValue())
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Value;
    }

    /**
     * {@inheritdoc}
     *
     * @throws NotNormalizableValueException
     */
    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        try {
            return '' === $data || null === $data ? null : new Value($data['type'], $data['value']);
        } catch (\Exception $e) {
            throw new NotNormalizableValueException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return isset(self::$supportedTypes[$type]);
    }
}
