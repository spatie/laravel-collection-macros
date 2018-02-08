<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class AfterTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_an_item_that_comes_after_an_item()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(2, $data->after(1));
    }

    /** @test */
    public function it_retrieves_items_by_value_and_doesnt_reorder_them()
    {
        $data = new Collection([
            4 => 3,
            2 => 1,
            1 => 2,
            3 => 4,
        ]);

        $this->assertEquals(1, $data->after(3));
    }

    /** @test */
    public function it_can_find_the_next_item_in_a_collection_of_strings()
    {
        $data = new Collection([
            'foo' => 'bar',
            'bar' => 'foo',
        ]);

        $this->assertEquals('foo', $data->after('bar'));
    }

    /** @test */
    public function it_can_find_the_next_item_based_on_a_callback()
    {
        $data = new Collection([3, 1, 2]);

        $result = $data->after(function ($item) {
            return $item > 2;
        });

        $this->assertEquals(1, $result);
    }

    /** @test */
    public function it_returns_null_if_there_isnt_a_next_item()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertNull($data->after(3));
    }

    /** @test */
    public function it_can_return_a_fallback_value_if_there_isnt_a_next_item()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(4, $data->after(3, 4));
    }
}
