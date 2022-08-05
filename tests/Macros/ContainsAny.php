<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ContainsAny extends TestCase
{
    /**
     * @test
     *
     * @dataProvider testCases
     */
    public function it_returns_true_if_the_collection_contains_at_least_one_of_the_given_items(
        bool $expectedResult,
        array $otherItems
    )
    {
        $actualResult = (new Collection(['a', 'b', 'c']))->containsAny($otherItems);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testCases(): array
    {
        return [
            [false, ['d', 'e']],
            [true, ['c', 'd']],
            [true, ['b', 'c']],
            [false, []],
        ];
    }
}
