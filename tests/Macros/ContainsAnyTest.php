<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ContainsAnyTest extends TestCase
{
    /** @test */
    public function it_contains_any()
    {
        $collection = Collection::make([1, 3, 5]);

        $this->assertTrue($collection->containsAny([1, 2]));
        $this->assertFalse($collection->containsAny([2, 4]));

        $this->assertTrue($collection->containsAny(1, 2));
        $this->assertFalse($collection->containsAny(2, 4));
    }
}
