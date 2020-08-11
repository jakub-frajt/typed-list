<?php
declare(strict_types=1);

namespace Frajt\Tests;

use Frajt\IntegerList;
use PHPUnit\Framework\TestCase;

class IntegerListTest extends TestCase
{
    /**
     * @dataProvider invalidDataProvider
     */
    public function testShouldCreateIntegerListWithInvalidValues(array $data): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new IntegerList($data);
    }

    public function invalidDataProvider(): iterable
    {
        return [
            'non numeric values'                       => [
                ['test', '1', 'aa'],
            ],
            'numeric values with last value as string' => [
                [1, 2, 3, 'test'],
            ],
        ];
    }

    /**
     * @dataProvider validValuesDataProvider
     */
    public function testShouldCreateIntegerListWithValidValues(array $data, array $expectedValues): void
    {
        $list = new IntegerList($data);
        $this->assertEquals($expectedValues, $list->getValues());
    }

    public function validValuesDataProvider(): iterable
    {
        yield [
            [1, 2, 3],
            [1, 2, 3],
        ];

        yield [
            ['1', '2', '3'],
            [1, 2, 3],
        ];
    }

    public function testShouldCountListItems(): void
    {
        $this->assertCount(0, new IntegerList([]));
        $this->assertCount(3, new IntegerList([1, 2, 3]));
    }

    public function testShouldGetCurrentItem(): void
    {
        $list = new IntegerList([1, 2, 3]);
        $this->assertSame(1, $list->current());
    }

    public function testShouldGetNextItem(): void
    {
        $list = new IntegerList([1, 2, 3]);
        $list->next();
        $this->assertSame(2, $list->current());
    }

    public function testShouldGetKey(): void
    {
        $list = new IntegerList([1, 2, 3]);
        $this->assertSame(0, $list->key());
        $list->next();
        $this->assertSame(1, $list->key());
    }

    public function testShouldRewind(): void
    {
        $list = new IntegerList([1, 2, 3]);
        $list->next();
        $list->rewind();
        $this->assertSame(0, $list->key());
    }

    public function testShouldCheckIfItemIsValid(): void
    {
        $list = new IntegerList([1, 2]);
        $this->assertTrue($list->valid());
        $list->next();
        $list->next();
        $list->next();
        $this->assertFalse($list->valid());
    }
}