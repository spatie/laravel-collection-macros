<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class AtTest extends TestCase
{
    /** @test */
    public function it_retrieves_an_item_by_positive_index()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(2, $data->at(1));
    }

    /** @test */
    public function it_retrieves_an_item_by_negative_index()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(3, $data->at(-1));
    }

    /** @test */
    public function it_retrieves_an_item_by_zero_index()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(1, $data->at(0));
    }
}
