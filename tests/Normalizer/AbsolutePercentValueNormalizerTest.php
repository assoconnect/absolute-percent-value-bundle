<?php

declare(strict_types=1);

namespace AssoConnect\AbsolutePercentValueBundle\Tests\Normalizer;

use AssoConnect\AbsolutePercentValueBundle\Normalizer\AbsolutePercentValueNormalizer;
use AssoConnect\AbsolutePercentValueBundle\Object\AbsolutePercentValue;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

class AbsolutePercentValueNormalizerTest extends TestCase
{
    private AbsolutePercentValueNormalizer $valueNormalizer;

    protected function setUp(): void
    {
        $this->valueNormalizer = new AbsolutePercentValueNormalizer();
    }

    /** @return iterable<mixed> */
    public function providerSupportsNormalization(): iterable
    {
        yield [new AbsolutePercentValue(AbsolutePercentValue::TYPE_ABSOLUTE, '20000'), true];
        yield [new \stdClass(), false];
    }

    /**
     * @param mixed $data
     * @dataProvider providerSupportsNormalization
     */
    public function testSupportsNormalization($data, bool $result): void
    {
        self::assertSame($result, $this->valueNormalizer->supportsNormalization($data));
    }

    public function testNormalize(): void
    {
        $value = new AbsolutePercentValue(AbsolutePercentValue::TYPE_ABSOLUTE, '20000');

        self::assertSame(
            [
                'type' => AbsolutePercentValue::TYPE_ABSOLUTE,
                'value' => '20000'
            ],
            $this->valueNormalizer->normalize($value)
        );
    }

    /** @return iterable<mixed> */
    public function providerSupportsDenormalization(): iterable
    {
        yield [AbsolutePercentValue::class, true];
        yield [\stdClass::class, false];
    }

    /**
     * @dataProvider providerSupportsDenormalization
     */
    public function testSupportsDenormalization(string $type, bool $result): void
    {
        self::assertSame($result, $this->valueNormalizer->supportsDenormalization([], $type));
    }

    /**
     * @dataProvider providerTestDenormalize
     */
    public function testDenormalizeFailure(mixed $data): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->valueNormalizer->denormalize($data, AbsolutePercentValue::class);
    }

    /** @return iterable<mixed> */
    public function providerTestDenormalize(): iterable
    {
        yield [''];
        yield [null];
        yield [['type' => AbsolutePercentValue::TYPE_ABSOLUTE]];
    }

    public function testDenormalizeSuccess(): void
    {
        $data = ['type' => AbsolutePercentValue::TYPE_ABSOLUTE, 'value' => '2000'];
        $value = $this->valueNormalizer->denormalize($data, AbsolutePercentValue::class);

        self::assertSame($data['type'], $value->getType());
        self::assertSame($data['value'], $value->getValue());
    }
}
