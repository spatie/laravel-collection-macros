<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

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

    /** @test */
    public function it_can_chunk_the_collection_with_a_given_callback_with_associative_keys()
    {
        $collection = new Collection(['a' => 'A', 'b' => 'A', 'c' => 'A', 'd' => 'B', 'e' => 'B', 'f' => 'A', 'g' => 'A', 'h' => 'C', 'i' => 'B', 'j' => 'B', 'k' => 'A']);

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

    /** @test */
    public function it_can_chunk_the_collection_with_a_given_callback_and_preserve_the_original_keys()
    {
        $collection = new Collection(['A', 'A', 'A', 'B', 'B', 'A', 'A', 'C', 'B', 'B', 'A']);

        $chunkedBy = $collection->chunkBy(function ($item) {
            return $item == 'A';
        }, true);

        $expected = [
            [0 => 'A', 1 => 'A', 2 => 'A'],
            [3 => 'B', 4 => 'B'],
            [5 => 'A', 6 => 'A'],
            [7 => 'C', 8 => 'B', 9 => 'B'],
            [10 => 'A'],
        ];

        $this->assertEquals($expected, $chunkedBy->toArray());
    }

    /** @test */
    public function it_can_chunk_the_collection_with_a_given_callback_with_associative_keys_and_preserve_the_original_keys()
    {
        $collection = new Collection(['a' => 'A', 'b' => 'A', 'c' => 'A', 'd' => 'B', 'e' => 'B', 'f' => 'A', 'g' => 'A', 'h' => 'C', 'i' => 'B', 'j' => 'B', 'k' => 'A']);

        $chunkedBy = $collection->chunkBy(function ($item) {
            return $item == 'A';
        }, true);

        $expected = [
            ['a' => 'A', 'b' => 'A', 'c' => 'A'],
            ['d' => 'B', 'e' => 'B'],
            ['f' => 'A', 'g' => 'A'],
            ['h' => 'C', 'i' => 'B', 'j' => 'B'],
            ['k' => 'A'],
        ];

        $this->assertEquals($expected, $chunkedBy->toArray());
    }
}
