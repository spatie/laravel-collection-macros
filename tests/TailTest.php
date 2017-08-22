<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class TailTest extends TestCase
{
    /** @test */
    public function it_provides_tail_macro()
    {
        $this->assertTrue(Collection::hasMacro('tail'));
    }

    /** @test */
    public function it_can_tail_the_collection_with_numbers()
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
          77
        ];

        $this->assertEquals($expected, $tail->toArray());
    }

    /** @test */
    public function it_can_tail_the_collection_with_strings()
    {
        $collection = new Collection(['1', '2', '3', 'Hello', 'Spatie']);

        $tail = $collection->tail();

        $expected = [
            '2',
            '3',
            'Hello',
            'Spatie'
        ];

        $this->assertEquals($expected, $tail->toArray());
    }
}
