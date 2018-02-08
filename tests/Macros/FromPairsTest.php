<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class FromPairsTest extends TestCase
{
    /** @test */
    public function it_provides_a_fromPairs_macro()
    {
        $this->assertTrue(Collection::hasMacro('fromPairs'));
    }

    /** @test */
    public function it_can_transform_a_collection_into_an_associative_array()
    {
        $this->assertEquals([
            'john@example.com' => 'John',
            'jane@example.com' => 'Jane',
            'dave@example.com' => 'Dave',
        ], Collection::make([
            ['john@example.com', 'John'],
            ['jane@example.com', 'Jane'],
            ['dave@example.com', 'Dave'],
        ])->fromPairs()->toArray());
    }
}
