<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class PowersetTest extends TestCase
{
    /** @test */
    public function it_enumerates_the_powerset()
    {
        /** @var Collection $subsets */
        $subsets = collect(['a' => 1, 'b' => 2, 'c' => 3])->powerset();

        static::assertEquals(8, $subsets->count());

        $subset = $subsets->get(0);
        static::assertEquals(0, $subset->count());

        $subset = $subsets->get(1);
        static::assertEquals(1, $subset->count());
        static::assertEquals(1, $subset['a']);

        $subset = $subsets->get(2);
        static::assertEquals(2, $subset->count());
        static::assertEquals(1, $subset['a']);
        static::assertEquals(2, $subset['b']);

        $subset = $subsets->get(3);
        static::assertEquals(1, $subset->count());
        static::assertEquals(2, $subset['b']);

        $subset = $subsets->get(4);
        static::assertEquals(2, $subset->count());
        static::assertEquals(2, $subset['b']);
        static::assertEquals(3, $subset['c']);

        $subset = $subsets->get(5);
        static::assertEquals(3, $subset->count());
        static::assertEquals(1, $subset['a']);
        static::assertEquals(2, $subset['b']);
        static::assertEquals(3, $subset['c']);

        $subset = $subsets->get(6);
        static::assertEquals(2, $subset->count());
        static::assertEquals(1, $subset['a']);
        static::assertEquals(3, $subset['c']);

        $subset = $subsets->get(7);
        static::assertEquals(1, $subset->count());
        static::assertEquals(3, $subset['c']);
    }
}
