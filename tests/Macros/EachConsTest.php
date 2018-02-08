<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class EachConsTest extends TestCase
{
    /** @test */
    public function it_provides_each_cons_macro()
    {
        $this->assertTrue(Collection::hasMacro('eachCons'));
    }

    /** @test */
    public function it_can_chunk_the_collection_into_consecutive_pairs_of_values_by_a_given_chunk_size_of_two()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $sliced = $collection->eachCons(2);

        $expected = [
            [1, 2],
            [2, 3],
            [3, 4],
            [4, 5],
            [5, 6],
            [6, 7],
            [7, 8],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function it_can_chunk_the_collection_into_consecutive_pairs_of_values_by_a_given_chunk_size_or_greater()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $sliced = $collection->eachCons(4);

        $expected = [
            [1, 2, 3, 4],
            [2, 3, 4, 5],
            [3, 4, 5, 6],
            [4, 5, 6, 7],
            [5, 6, 7, 8],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }

    /** @test */
    public function it_can_chunk_the_collection_into_consecutive_pairs_of_values_by_a_given_chunk_size_of_two_with_preserving_the_original_keys()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $sliced = $collection->eachCons(2, true);

        $expected = [
            [0 => 1, 1 => 2],
            [1 => 2, 2 => 3],
            [2 => 3, 3 => 4],
            [3 => 4, 4 => 5],
            [4 => 5, 5 => 6],
            [5 => 6, 6 => 7],
            [6 => 7, 7 => 8],
        ];

        $this->assertEquals($expected, $sliced->toArray());
    }
}
