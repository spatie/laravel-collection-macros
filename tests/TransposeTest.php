<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class TransposeTest extends TestCase
{
    /** @test */
    public function it_can_transpose_an_array()
    {
        $collection = Collection::make(
            [['foo', 'foo1'], ['bar', 'bar1'], ['baz', 'baz1']]
        );

        $this->assertEquals(
            [['foo', 'bar', 'baz'], ['foo1', 'bar1', 'baz1']],
            $collection->transpose()->toArray()
        );
    }
}
