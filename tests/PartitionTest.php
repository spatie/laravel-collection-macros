<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class PartitionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        if (method_exists(new Collection(), 'partition')) {
            $this->markTestSkipped('This Laravel version is using a built in version of partition.');
        }
    }

    /** @test */
    public function it_can_handle_an_empty_collection()
    {
        $collection = Collection::make([])->partition(function () {
            return true;
        });

        $this->assertCount(2, $collection);
    }

    /** @test */
    public function it_puts_all_the_items_the_pass_the_callback_in_the_first_array_others_in_the_second()
    {
        $collection = Collection::make(range(1, 10))->partition(function ($i) {
            return $i <= 5;
        });

        $this->assertEquals([1, 2, 3, 4, 5], $collection[0]->toArray());
        $this->assertEquals([6, 7, 8, 9, 10], $collection[1]->toArray());
    }
}
