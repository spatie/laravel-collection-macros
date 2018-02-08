<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class WithSizeTest extends TestCase
{
    /** @test */
    public function it_can_create_a_collection_with_the_specified_size()
    {
        $this->assertEquals([1], Collection::withSize(1)->toArray());
        $this->assertEquals([1, 2, 3], Collection::withSize(3)->toArray());
    }

    /** @test */
    public function it_can_creates_an_empty_collection_if_the_given_size_is_lower_than_one()
    {
        $this->assertCount(0, Collection::withSize(0));
        $this->assertCount(0, Collection::withSize(-1));
    }
}
