<?php

use Illuminate\Support\Collection;

it('provides `eachCons` macro')
    ->expect(fn () => Collection::hasMacro('eachCons'))
    ->toBeTrue();

it('can chunk the collection into consecutive pairs of values by a given chunk size of two', function () {
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

    expect($sliced->toArray())->toEqual($expected);
});

it('can chunk the collection into consecutive pairs of values by a given chunk size or greater', function () {
    $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

    $sliced = $collection->eachCons(4);

    $expected = [
        [1, 2, 3, 4],
        [2, 3, 4, 5],
        [3, 4, 5, 6],
        [4, 5, 6, 7],
        [5, 6, 7, 8],
    ];

    expect($sliced->toArray())->toEqual($expected);
});

it(
    'can chunk the collection into consecutive pairs of values by a given chunk size of two with preserving the original key',
    function () {
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

        expect($sliced->toArray())->toEqual($expected);
    }
);
