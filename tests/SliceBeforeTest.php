<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class SliceBeforeTest extends TestCase
{
    /** @test */
    public function it_provides_slice_before_macro()
    {
        $this->assertTrue(Collection::hasMacro('sliceBefore'));
    }

    /** @test */
    public function it_can_slice_before_the_collection_with_a_given_callback()
    {
        $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

        $sliced = $collection->sliceBefore(function ($number) {
            return $number > 50;
        });

        $expected = [
            [10, 34],
            [51, 17, 47],
            [64, 9, 44, 20],
            [59],
            [66],
            [77],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }
}
