<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class PadTest extends TestCase
{
    /** @test */
    public function it_can_pad_a_collection_if_the_count_is_less()
    {
        $this->assertCount(5, Collection::make(['a', 'b', 'c', 'd'])->pad(5, '')->toArray());
    }

    /** @test */
    public function it_can_pad_a_collection_if_the_count_is_more()
    {
        $this->assertCount(4, Collection::make(['a', 'b', 'c', 'd'])->pad(2, '')->toArray());
    }

    /** @test */
    public function it_can_pad_an_empty_collection_without_getting_an_error()
    {
        $this->assertCount(2, Collection::make([])->pad(2, '')->toArray());
    }
}
