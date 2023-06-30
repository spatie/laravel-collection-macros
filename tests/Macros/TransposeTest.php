<?php


use Illuminate\Support\Collection;

it('can transpose an array', function (Collection $collection, Collection $expected) {
    expect($collection->transpose())->toEqual($expected);
})->with([
    'empty' => [
        new Collection(),
        new Collection(),
    ],
    'single-element' => [
        new Collection([
            ['11'],
        ]),
        new Collection([
            new Collection(['11']),
        ]),
    ],
    'single-row' => [
        new Collection([
            ['11', '12', '13'],
        ]),
        new Collection([
            new Collection(['11']),
            new Collection(['12']),
            new Collection(['13']),
        ]),
    ],
    'single-column' => [
        new Collection([
            ['11'],
            ['12'],
            ['13'],
        ]),
        new Collection([
            new Collection(['11', '12', '13']),
        ]),
    ],
    'tall-rect' => [
        new Collection([
            ['11', '12'],
            ['21', '22'],
            ['31', '32'],
        ]),
        new Collection([
            new Collection(['11', '21', '31']),
            new Collection(['12', '22', '32']),
        ]),
    ],
    'wide-rect' => [
        new Collection([
            ['11', '12', '13'],
            ['21', '22', '23'],
        ]),
        new Collection([
            new Collection(['11', '21']),
            new Collection(['12', '22']),
            new Collection(['13', '23']),
        ]),
    ],
    'square' => [
        new Collection([
            ['11', '12', '13'],
            ['21', '22', '23'],
            ['31', '32', '33'],
        ]),
        new Collection([
            new Collection(['11', '21', '31']),
            new Collection(['12', '22', '32']),
            new Collection(['13', '23', '33']),
        ]),
    ],
    'arrayable' => [
        new Collection([
            ['11', '12', '13'],
            new ArrayObject(['21', '22', '23']),
            new Collection(['31', '32', '33']),
        ]),
        new Collection([
            new Collection(['11', '21', '31']),
            new Collection(['12', '22', '32']),
            new Collection(['13', '23', '33']),
        ]),
    ],
]);

it('will enforce length equality', function () {
    $this->expectException(LengthException::class);
    $this->expectExceptionMessage("Element's length must be equal.");

    $collection = new Collection([
        ['11', '12', '13'],
        ['21', '22'],
        ['31', '32', '33'],
    ]);

    $collection->transpose();
});

it('will remove existing keys', function () {
    $collection = new Collection([
        'one' => ['11', '12', '13'],
        'two' => ['21', '22', '23'],
        'three' => ['31', '32', '33'],
    ]);

    $expected = new Collection([
        new Collection(['11', '21', '31']),
        new Collection(['12', '22', '32']),
        new Collection(['13', '23', '33']),
    ]);

    expect($collection->transpose())->toEqual($expected);
});

it('can transpose a single row array', function () {
    $collection = new Collection([
        ['11', '12', '13'],
    ]);

    $expected = new Collection([
        new Collection(['11']),
        new Collection(['12']),
        new Collection(['13']),
    ]);

    expect($collection->transpose())->toEqual($expected);
});

it('can handle null values', function () {
    $collection = new Collection([
        null,
    ]);

    $expected = new Collection();

    expect($collection->transpose())->toEqual($expected);
});

it('can handle collections values', function () {
    $collection = new Collection([
        new Collection([1, 2, 3]),
    ]);

    $expected = new Collection([
        new Collection([1]),
        new Collection([2]),
        new Collection([3]),
    ]);

    expect($collection->transpose())->toEqual($expected);
});
