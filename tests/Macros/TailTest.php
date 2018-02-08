<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class TailTest extends TestCase
{
    /** @test */
    public function it_provides_tail_macro()
    {
        $this->assertTrue(Collection::hasMacro('tail'));
    }

    /** @test */
    public function it_can_tail_the_collection_with_numbers_without_preserving_the_keys()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $tail = $collection->tail();

        $expected = [
            34,
            51,
            17,
            47,
            64,
            9,
            44,
            20,
            59,
            66,
            77,
        ];

        $this->assertEquals($expected, $tail->toArray());
    }

    /** @test */
    public function it_can_tail_the_collection_with_strings_without_preserving_the_keys()
    {
        $collection = new Collection(['1', '2', '3', 'Hello', 'Spatie']);

        $tail = $collection->tail();

        $expected = [
            '2',
            '3',
            'Hello',
            'Spatie',
        ];

        $this->assertEquals($expected, $tail->toArray());
    }

    /** @test */
    public function it_can_tail_the_collection_with_numbers_with_preserving_the_keys()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $tail = $collection->tail(true);

        $expected = [
            1 => 34,
            2 => 51,
            3 => 17,
            4 => 47,
            5 => 64,
            6 => 9,
            7 => 44,
            8 => 20,
            9 => 59,
            10 => 66,
            11 => 77,
        ];

        $this->assertEquals($expected, $tail->toArray());
    }

    /** @test */
    public function it_can_tail_the_collection_with_strings()
    {
        $collection = new Collection(['1', '2', '3', 'Hello', 'Spatie']);

        $tail = $collection->tail(true);

        $expected = [
            1 => '2',
            2 => '3',
            3 => 'Hello',
            4 => 'Spatie',
        ];

        $this->assertEquals($expected, $tail->toArray());
    }
}
