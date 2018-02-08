<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class RotateTest extends TestCase
{
    /** @test */
    public function it_provides_rotate_macro()
    {
        $this->assertTrue(Collection::hasMacro('rotate'));
    }

    /** @test */
    public function it_can_return_empty_collection_if_given_empty_collecton()
    {
        $collection = new Collection([]);
        $this->assertCount(0, $collection->rotate(2)->toArray());
    }

    /** @test */
    public function it_can_return_same_collection_if_given_zero_offset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);
        $this->assertEquals([1, 2, 3, 4, 5, 6], $collection->rotate(0)->toArray());
    }

    /** @test */
    public function it_can_rotate_the_collection_with_offset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);
        $this->assertEquals([3, 4, 5, 6, 1, 2], $collection->rotate(2)->toArray());
    }

    /** @test */
    public function it_can_rotate_the_collection_with_negative_offset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);
        $this->assertEquals([5, 6, 1, 2, 3, 4], $collection->rotate(-2)->toArray());
    }

    /** @test */
    public function it_can_rotate_the_collection_with_offset_with_keys()
    {
        $collection = new Collection(['first' => 1, 'second' => 2, 'third' => 3, 'fourth' => 4, 'fifth' => 5]);
        $this->assertEquals(['fourth' => 4, 'fifth' => 5, 'first' => 1, 'second' => 2, 'third' => 3], $collection->rotate(3)->toArray());
    }

    /** @test */
    public function it_can_rotate_the_collection_with_nagative_offset_with_keys()
    {
        $collection = new Collection(['first' => 1, 'second' => 2, 'third' => 3, 'fourth' => 4, 'fifth' => 5]);
        $this->assertEquals(['third' => 3, 'fourth' => 4, 'fifth' => 5, 'first' => 1, 'second' => 2], $collection->rotate(-3)->toArray());
    }
}
