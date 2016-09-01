<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class SplitTest extends TestCase
{
    /** @test */
    public function it_can_split_a_collection_if_the_count_is_divisible()
    {
        $this->assertEquals(
            [['a', 'b'], ['c', 'd']],
            Collection::make(['a', 'b', 'c', 'd'])->split(2)->map(function (Collection $chunk) {
                return $chunk->values()->toArray();
            })->toArray()
        );
    }

    /** @test */
    public function it_can_split_a_collection_if_the_count_isnt_divisible()
    {
        $this->assertEquals(
            [['a', 'b'], ['c']],
            Collection::make(['a', 'b', 'c'])->split(2)->map(function (Collection $chunk) {
                return $chunk->values()->toArray();
            })->toArray()
        );
    }

    /** @test */
    public function it_can_split_a_collection_if_the_count_is_less_than_the_divisor()
    {
        $this->assertEquals(
            [['a']],
            Collection::make(['a'])->split(2)->map(function (Collection $chunk) {
                return $chunk->values()->toArray();
            })->toArray()
        );
    }

    /** @test */
    public function it_can_split_an_empty_collection_without_getting_an_error()
    {
        $this->assertEquals(
            [],
            Collection::make([])->split(2)->map(function (Collection $chunk) {
                return $chunk->values()->toArray();
            })->toArray()
        );
    }
}
