<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class DoesNotContainTest extends TestCase
{
    /** @test */
    public function it_does_not_contains()
    {
        $collection = Collection::make([1, 3, 5]);

        $this->assertTrue($collection->doesNotContain([2, 4]));
        $this->assertFalse($collection->doesNotContain([1, 2]));

        $this->assertTrue($collection->doesNotContain(2, 4));
        $this->assertFalse($collection->doesNotContain(1, 2));
    }
}
