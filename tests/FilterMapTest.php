<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class FilterMapTest extends TestCase
{
    /** @test */
    public function it_returns_a_mapped_collection_without_empty_values()
    {
        $result = Collection::make([1, 2, 3, 4, 5, 6])->filterMap(function ($number) {
            $quotient = $number / 3;

            return is_integer($quotient) ? $quotient : null;
        });

        $this->assertEquals([1, 2], $result->values()->toArray());
    }
}
