<?php

use Illuminate\Support\Collection;

it(
    'returns true if collection contains all given items',
    function (bool $expectedResult, array $otherItems) {
        $actualResult = (new Collection(['a', 'b', 'c']))->containsAll($otherItems);

        expect($actualResult)->toEqual($expectedResult);
    }
)->with([
    [false, ['d', 'e']],
    [false, ['c', 'd']],
    [true, ['b', 'c']],
    [true, []],
]);
