<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class BeforeTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_an_item_that_comes_before_an_item()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals(1, $data->before(2));
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

        $this->assertEquals(2, $data->before(4));
    }

    /** @test */
    public function it_can_find_the_previous_item_in_a_collection_of_strings()
    {
        $data = new Collection([
            'foo' => 'bar',
            'bar' => 'foo',
        ]);

        $this->assertEquals('bar', $data->before('foo'));
    }

    /** @test */
    public function it_can_find_the_previous_item_based_on_a_callback()
    {
        $data = new Collection([3, 1, 2]);

        $result = $data->before(function ($item) {
            return $item < 2;
        });

        $this->assertEquals(3, $result);
    }

    /** @test */
    public function it_returns_null_if_there_isnt_a_previous_item()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertNull($data->before(1));
    }

    /** @test */
    public function it_can_return_a_fallback_value_if_there_isnt_a_previous_item()
    {
        $data = new Collection([1, 2, 3]);

        $this->assertEquals('The void', $data->before(1, 'The void'));
    }
}
