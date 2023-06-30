<?php


use Illuminate\Support\Collection;

it('moves a single element to the start of the collection', function () {
    $collection = Collection::make([
        ['id' => 1],
        ['id' => 2],
        ['id' => 3],
    ]);

    $prioritized = $collection->prioritize(function (array $item) {
        return $item['id'] === 2;
    });

    expect($prioritized->pluck('id')->toArray())->toEqual([2, 1, 3]);
});

it('moves multiple elements to the start of the collection', function () {
    $collection = Collection::make([
        ['id' => 1],
        ['id' => 2],
        ['id' => 3],
        ['id' => 4],
    ]);

    $prioritized = $collection->prioritize(function (array $item) {
        return in_array($item['id'], [2, 4]);
    });

    expect($prioritized->pluck('id')->toArray())->toEqual([2, 4, 1, 3]);
});

it('keeps keys of the original collection', function () {
    $collection = Collection::make([
        [
            'mfr' => 'Apple',
            'name' => 'iPhone Xs',
        ],
        [
            'mfr' => 'Google',
            'name' => 'Pixel 3',
        ],
        [
            'mfr' => 'Microsoft',
            'name' => 'Lumia 950',
        ],
        [
            'mfr' => 'OnePlus',
            'name' => '6T',
        ],
        [
            'mfr' => 'Samsung',
            'name' => 'Galaxy S9',
        ],
    ])->keyBy('mfr');

    $prioritized = $collection->prioritize(function ($phones, $mfr) {
        return in_array($mfr, ['OnePlus', 'Samsung']);
    });
    expect($prioritized->keys()->toArray())->toEqual(['OnePlus', 'Samsung', 'Apple', 'Google', 'Microsoft']);
});
