<?php

declare(strict_types=1);

namespace AssoConnect\AbsolutePercentValueBundle\Object;

use Assert\Assertion;

/**
 * AbsolutePercentValue representing either an absolute value or a percent
 */
class AbsolutePercentValue
{
    public const TYPE_ABSOLUTE = 'ABSOLUTE';
    public const TYPE_PERCENT = 'PERCENT';

    private const TYPES = [
        self::TYPE_ABSOLUTE,
        self::TYPE_PERCENT
    ];

    private string $type;

    private string $value;

    public function __construct(string $type, string $value)
    {
        Assertion::inArray($type, self::TYPES);
        Assertion::numeric($value);

        Assertion::greaterThan(intval($value), 1);

        // if type is PERCENT, check value is valid (1 < $value < 10000)
        if ($type === self::TYPE_PERCENT) {
            Assertion::between(intval($value), 1, 10000);
        }

        $this->type = $type;
        $this->value = $value;
    }


    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->type . ' ' . $this->value;
    }
}
