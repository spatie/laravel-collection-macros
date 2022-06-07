<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ContainsAnyTest extends TestCase
{
    /** @test */
    public function it_contains_any()
    {
        $c = Collection::make([1, 3, 5]);

        $this->assertTrue($c->containsAny([1, 2]));
        $this->assertFalse($c->containsAny([2, 4]));
    }
}
