<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ContainsAnyNoneTest extends TestCase
{
    /** @test */
    public function it_contains_any_none()
    {
        $collection = Collection::make([1, 3, 5]);

        $this->assertTrue($collection->containsAnyNone([2, 4]));
        $this->assertFalse($collection->containsAnyNone([1, 2]));
    }
}
