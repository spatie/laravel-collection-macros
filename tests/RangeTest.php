<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class RangeTest extends TestCase
{
    /** @test */
    public function it_can_create_a_basic_range()
    {
        $this->assertEquals([1, 2, 3], Collection::range(1, 3)->toArray());
        $this->assertEquals([3, 4, 5], Collection::range(3, 5)->toArray());
    }

    /** @test */
    public function it_can_create_a_range_with_a_specified_step_size()
    {
        $this->assertEquals([2, 4, 6], Collection::range(2, 6, 2)->toArray());
    }
}
