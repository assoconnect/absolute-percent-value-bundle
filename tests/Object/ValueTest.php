<?php

declare(strict_types=1);

namespace AssoConnect\AbsolutePercentValueBundle\Tests\Object;

use AssoConnect\AbsolutePercentValueBundle\Object\Value;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    public function testConstructBadType(): void
    {
        $type = 'a';
        $value = '2000';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Value "%s" is not an element of the valid values: %s, %s',
            $type,
            Value::TYPE_ABSOLUTE,
            Value::TYPE_PERCENT
        ));
        new Value($type, $value);
    }

    public function testConstructValueNotNumeric(): void
    {
        $type =  Value::TYPE_ABSOLUTE;
        $value = 'a';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Value "%s" is not numeric.',
            $value
        ));
        new Value($type, $value);
    }

    public function testConstructInvalidValueForPercent(): void
    {
        $type = Value::TYPE_PERCENT;
        $value = '300000';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Provided "%s" is neither greater than or equal to "1" nor less than or equal to "10000".',
            $value
        ));
        new Value($type, $value);
    }

    public function testConstructValueForAbsolute(): void
    {
        $type = Value::TYPE_ABSOLUTE;
        $value = '300000';

        $absolutePercentValue = new Value($type, $value);

        $this->assertSame($type, $absolutePercentValue->getType());
        $this->assertSame($value, $absolutePercentValue->getValue());
    }

    /**
     * @param $type
     *
     * @dataProvider providerTypes
     */
    public function testConstructSuccess(string $type): void
    {
        $value = '2000';

        $absolutePercentValue = new Value($type, $value);
        $this->assertSame($type, $absolutePercentValue->getType());
        $this->assertSame($value, $absolutePercentValue->getValue());
    }

    public function providerTypes()
    {
        yield [Value::TYPE_PERCENT];
        yield [Value::TYPE_ABSOLUTE];
    }
}
