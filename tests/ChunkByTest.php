<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class ChunkByTest extends TestCase
{
    /** @test */
    public function it_provides_chunk_by_macro()
    {
        $this->assertTrue(Collection::hasMacro('chunkBy'));
    }

    /** @test */
    public function it_can_chunk_the_collection_with_a_given_callback()
    {
        $collection = new Collection(['A', 'A', 'A', 'B', 'B', 'A', 'A', 'C', 'B', 'B', 'A']);

        $chunkedBy = $collection->chunkBy(function ($item) {
            return $item == 'A';
        });

        $expected = [
            ['A', 'A', 'A'],
            ['B', 'B'],
            ['A', 'A'],
            ['C', 'B', 'B'],
            ['A'],
        ];

        $this->assertEquals($expected, $chunkedBy->toArray());
    }
}
