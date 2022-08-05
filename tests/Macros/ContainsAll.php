<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ContainsAll extends TestCase
{
    /**
     * @test
     *
     * @dataProvider testCases
     */
    public function it_returns_true_if_the_collection_contains_all_given_items(
        bool $expectedResult,
        array $otherItems
    ) {
        $actualResult = (new Collection(['a', 'b', 'c']))->containsAll($otherItems);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testCases(): array
    {
        return [
            [false, ['d', 'e']],
            [false, ['c', 'd']],
            [true, ['b', 'c']],
            [true, []],
        ];
    }
}
