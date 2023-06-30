<?php


use Illuminate\Support\Collection;

it('provides chunk by macro', function () {
    expect(Collection::hasMacro('chunkBy'))->toBeTrue();
});

it('can chunk the collection with a given callback', function () {
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

    expect($chunkedBy->toArray())->toEqual($expected);
});

it('can chunk the collection with a given callback with associative keys', function () {
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

    expect($chunkedBy->toArray())->toEqual($expected);
});

it('can chunk the collection with a given callback and preserve the original keys', function () {
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

    expect($chunkedBy->toArray())->toEqual($expected);
});

it('can chunk the collection with a given callback with associative keys and preserve the original keys', function () {
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

    expect($chunkedBy->toArray())->toEqual($expected);
});
