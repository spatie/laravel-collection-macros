<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class ByIndexTest extends TestCase
{
    /** @test */
    public function it_retrieves_an_item_by_positive_index()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(2, $data->byIndex(1));
    }

    /** @test */
    public function it_retrieves_an_item_by_negative_index()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(3, $data->byIndex(-1));
    }

    /** @test */
    public function it_retrieves_an_item_by_zero_index()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(1, $data->byIndex(0));
    }
}
