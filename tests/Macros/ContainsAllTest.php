<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ContainsAllTest extends TestCase
{
    /** @test */
    public function it_contains_all()
    {
        $collection = Collection::make([1, 3, 5]);

        $this->assertTrue($collection->containsAll([1, 3, 5]));
        $this->assertTrue($collection->containsAll(['1', '3', '5']));
        $this->assertFalse($collection->containsAll([2]));
        $this->assertFalse($collection->containsAll(['2']));
    }
}
