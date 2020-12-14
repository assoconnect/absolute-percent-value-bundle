<?php

declare(strict_types=1);

namespace AssoConnect\AbsolutePercentValueBundle\Tests\Object;

use AssoConnect\AbsolutePercentValueBundle\Object\AbsolutePercentValue;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AbsolutePercentValueTest extends TestCase
{
    public function testConstructBadType(): void
    {
        $type = 'a';
        $value = '2000';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Value "%s" is not an element of the valid values: %s, %s',
            $type,
            AbsolutePercentValue::TYPE_ABSOLUTE,
            AbsolutePercentValue::TYPE_PERCENT
        ));
        new AbsolutePercentValue($type, $value);
    }

    public function testConstructValueNotNumeric(): void
    {
        $type =  AbsolutePercentValue::TYPE_ABSOLUTE;
        $value = 'a';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Value "%s" is not numeric.',
            $value
        ));
        new AbsolutePercentValue($type, $value);
    }

    public function testConstructInvalidValueForPercent(): void
    {
        $type = AbsolutePercentValue::TYPE_PERCENT;
        $value = '300000';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Provided "%s" is neither greater than or equal to "1" nor less than or equal to "10000".',
            $value
        ));
        new AbsolutePercentValue($type, $value);
    }

    public function testConstructValueForAbsolute(): void
    {
        $type = AbsolutePercentValue::TYPE_ABSOLUTE;
        $value = '300000';

        $absolutePercentValue = new AbsolutePercentValue($type, $value);

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

        $absolutePercentValue = new AbsolutePercentValue($type, $value);
        $this->assertSame($type, $absolutePercentValue->getType());
        $this->assertSame($value, $absolutePercentValue->getValue());
    }

    public function providerTypes()
    {
        yield [AbsolutePercentValue::TYPE_PERCENT];
        yield [AbsolutePercentValue::TYPE_ABSOLUTE];
    }
}
