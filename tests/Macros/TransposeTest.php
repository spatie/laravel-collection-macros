<?php

namespace Spatie\CollectionMacros\Test\Macros;

use ArrayObject;
use Illuminate\Support\Collection;
use LengthException;
use Spatie\CollectionMacros\Test\TestCase;

class TransposeTest extends TestCase
{
    public function transposableCollections(): array
    {
        return [
            'empty' => [
                new Collection(),
                new Collection(),
            ],
            'single-element' => [
                new Collection([
                    ['11'],
                ]),
                new Collection([
                    new Collection(['11']),
                ]),
            ],
            'single-row' => [
                new Collection([
                    ['11', '12', '13'],
                ]),
                new Collection([
                    new Collection(['11']),
                    new Collection(['12']),
                    new Collection(['13']),
                ]),
            ],
            'single-column' => [
                new Collection([
                    ['11'],
                    ['12'],
                    ['13'],
                ]),
                new Collection([
                    new Collection(['11', '12', '13']),
                ]),
            ],
            'tall-rect' => [
                new Collection([
                    ['11', '12'],
                    ['21', '22'],
                    ['31', '32'],
                ]),
                new Collection([
                    new Collection(['11', '21', '31']),
                    new Collection(['12', '22', '32']),
                ]),
            ],
            'wide-rect' => [
                new Collection([
                    ['11', '12', '13'],
                    ['21', '22', '23'],
                ]),
                new Collection([
                    new Collection(['11', '21']),
                    new Collection(['12', '22']),
                    new Collection(['13', '23']),
                ]),
            ],
            'square' => [
                new Collection([
                    ['11', '12', '13'],
                    ['21', '22', '23'],
                    ['31', '32', '33'],
                ]),
                new Collection([
                    new Collection(['11', '21', '31']),
                    new Collection(['12', '22', '32']),
                    new Collection(['13', '23', '33']),
                ]),
            ],
            'arrayable' => [
                new Collection([
                    ['11', '12', '13'],
                    new ArrayObject(['21', '22', '23']),
                    new Collection(['31', '32', '33']),
                ]),
                new Collection([
                    new Collection(['11', '21', '31']),
                    new Collection(['12', '22', '32']),
                    new Collection(['13', '23', '33']),
                ]),
            ],
        ];
    }

    /**
     * @test
     * @dataProvider transposableCollections
     */
    public function it_can_transpose_an_array(Collection $collection, Collection $expected)
    {
        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function it_will_enforce_length_equality()
    {
        $this->expectException(LengthException::class);
        $this->expectExceptionMessage("Element's length must be equal.");

        $collection = new Collection([
            ['11', '12', '13'],
            ['21', '22'],
            ['31', '32', '33'],
        ]);

        $collection->transpose();
    }

    /** @test */
    public function it_will_remove_existing_keys()
    {
        $collection = new Collection([
            'one' => ['11', '12', '13'],
            'two' => ['21', '22', '23'],
            'three' => ['31', '32', '33'],
        ]);

        $expected = new Collection([
            new Collection(['11', '21', '31']),
            new Collection(['12', '22', '32']),
            new Collection(['13', '23', '33']),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function it_can_transpose_a_single_row_array()
    {
        $collection = new Collection([
            ['11', '12', '13'],
        ]);

        $expected = new Collection([
            new Collection(['11']),
            new Collection(['12']),
            new Collection(['13']),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function it_can_handle_null_values()
    {
        $collection = new Collection([
            null,
        ]);

        $expected = new Collection();

        $this->assertEquals($expected, $collection->transpose());
    }

    /** @test */
    public function it_can_handle_collections_values()
    {
        $collection = new Collection([
            new Collection([1, 2, 3]),
        ]);

        $expected = new Collection([
            new Collection([1]),
            new Collection([2]),
            new Collection([3]),
        ]);

        $this->assertEquals($expected, $collection->transpose());
    }
}
