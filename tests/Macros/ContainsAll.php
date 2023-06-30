<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;


it('returns true if the collection contains all given items', function (
    bool $expectedResult,
    array $otherItems
) {
    $actualResult = (new Collection(['a', 'b', 'c']))->containsAll($otherItems);

    $this->assertEquals($expectedResult, $actualResult);
})->with([
    [false, ['d', 'e']],
    [false, ['c', 'd']],
    [true, ['b', 'c']],
    [true, []],
]);

