<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class FilterMapTest extends TestCase
{
    /** @test */
    public function it_returns_a_mapped_collection_without_empty_values()
    {
        $result = Collection::make([1, 2, 3, 4, 5, 6])->filterMap(function ($number) {
            $half = $number / 2;

            return is_float($half)
                ? null
                : $half;
        });

        $this->assertEquals([1, 2, 3], $result->values()->toArray());
    }
}
