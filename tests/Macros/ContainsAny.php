<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;


it('returns true if the collection contains at least one of the given items', function (
    bool $expectedResult,
    array $otherItems
) {
    $actualResult = (new Collection(['a', 'b', 'c']))->containsAny($otherItems);

    $this->assertEquals($expectedResult, $actualResult);
})->with([
    [false, ['d', 'e']],
    [true, ['c', 'd']],
    [true, ['b', 'c']],
    [false, []],
]);
