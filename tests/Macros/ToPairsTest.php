<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ToPairsTest extends TestCase
{
    /** @test */
    public function it_provides_a_fromPairs_macro()
    {
        $this->assertTrue(Collection::hasMacro('fromPairs'));
    }

    /** @test */
    public function it_can_transform_a_collection_into_an_array_with_pairs()
    {
        $this->assertEquals([
            ['john@example.com', 'John'],
            ['jane@example.com', 'Jane'],
            ['dave@example.com', 'Dave'],
        ], Collection::make([
            'john@example.com' => 'John',
            'jane@example.com' => 'Jane',
            'dave@example.com' => 'Dave',
        ])->toPairs()->toArray());
    }
}
