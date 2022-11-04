<?php

use Illuminate\Support\Collection;

it('returns true if the collection contains alt least one of the given items', function (
    bool $expectedResult,
    array $otherItems
) {
    $actualResult = (new Collection(['a', 'b', 'c']))->containsAny($otherItems);

    expect($actualResult)->toEqual($expectedResult);
})->with([
    [false, ['d', 'e']],
    [true, ['c', 'd']],
    [true, ['b', 'c']],
    [false, []],
]);
