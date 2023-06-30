<?php


use Illuminate\Support\Collection;

it('provides tail macro', function () {
    expect(Collection::hasMacro('tail'))->toBeTrue();
});

it('can tail the collection with numbers without preserving the keys', function () {
    $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

    $tail = $collection->tail();

    $expected = [
        34,
        51,
        17,
        47,
        64,
        9,
        44,
        20,
        59,
        66,
        77,
    ];

    expect($tail->toArray())->toEqual($expected);
});

it('can tail the collection with strings without preserving the keys', function () {
    $collection = new Collection(['1', '2', '3', 'Hello', 'Spatie']);

    $tail = $collection->tail();

    $expected = [
        '2',
        '3',
        'Hello',
        'Spatie',
    ];

    expect($tail->toArray())->toEqual($expected);
});

it('can tail the collection with numbers with preserving the keys', function () {
    $collection = new Collection([10, 34, 51, 17, 47, 64, 9, 44, 20, 59, 66, 77]);

    $tail = $collection->tail(true);

    $expected = [
        1 => 34,
        2 => 51,
        3 => 17,
        4 => 47,
        5 => 64,
        6 => 9,
        7 => 44,
        8 => 20,
        9 => 59,
        10 => 66,
        11 => 77,
    ];

    expect($tail->toArray())->toEqual($expected);
});

it('can tail the collection with strings', function () {
    $collection = new Collection(['1', '2', '3', 'Hello', 'Spatie']);

    $tail = $collection->tail(true);

    $expected = [
        1 => '2',
        2 => '3',
        3 => 'Hello',
        4 => 'Spatie',
    ];

    expect($tail->toArray())->toEqual($expected);
});
