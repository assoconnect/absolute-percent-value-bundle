<?php

declare(strict_types=1);


namespace AssoConnect\AbsolutePercentValueBundle\Tests\Normalizer;


use AssoConnect\AbsolutePercentValueBundle\Normalizer\ValueNormalizer;
use AssoConnect\AbsolutePercentValueBundle\Object\Value;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;

class ValueNormalizerTest extends TestCase
{
    private ValueNormalizer $valueNormalizer;

    protected function setUp(): void
    {
        $this->valueNormalizer = new ValueNormalizer();
    }

    public function providerSupportsNormalization()
    {
        yield [new Value(Value::TYPE_ABSOLUTE, '20000'), true];
        yield [new \stdClass(), false];
    }

    /**
     * @param $object
     * @param $result
     *
     * @dataProvider providerSupportsNormalization
     */
    public function testSupportsNormalization($object, $result)
    {
        $this->assertSame($result, $this->valueNormalizer->supportsNormalization($object));
    }

    public function testNormalize()
    {
        $value = new Value(Value::TYPE_ABSOLUTE, '20000');

        $this->assertSame(
            [
                'type' => Value::TYPE_ABSOLUTE,
                'value' => '20000'
            ],
            $this->valueNormalizer->normalize($value)
        );
    }

    public function providerSupportsDenormalization()
    {
        yield [Value::class, true];
        yield [\stdClass::class, false];
    }

    /**
     * @param $type
     * @param $result
     *
     * @dataProvider providerSupportsDenormalization
     */
    public function testSupportsDenormalization($type, $result)
    {
        $this->assertSame($result, $this->valueNormalizer->supportsDenormalization([], $type));
    }

    public function providerTestDenormalize()
    {
        yield [''];
        yield [null];
    }

    /**
     * @param $data
     *
     * @dataProvider providerTestDenormalize
     */
    public function testDenormalizeNull($data)
    {
        $value = $this->valueNormalizer->denormalize($data, Value::class);
        $this->assertNull($value);
    }

    public function testDenormalizeSuccess()
    {
        $data = ['type' => Value::TYPE_ABSOLUTE, 'value' => '2000'];
        $value = $this->valueNormalizer->denormalize($data, Value::class);

        $this->assertSame($data['type'], $value->getType());
        $this->assertSame($data['value'], $value->getValue());
    }

    public function testDenormalizeFailure()
    {
        $data = ['type' => Value::TYPE_ABSOLUTE];
        $this->expectException(NotNormalizableValueException::class);
        $this->valueNormalizer->denormalize($data, Value::class);
    }
}
