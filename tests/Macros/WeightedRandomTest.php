<?php


use Illuminate\Support\Collection;

it('will probably return the heaviest item most', function () {
    $items = collect([
        ['value' => 'a', 'weight' => 1],
        ['value' => 'b', 'weight' => 10],
        ['value' => 'c', 'weight' => 1],
    ]);

    $mostPopularValue = Collection::range(0, 1000)
        ->map(function () use ($items) {
            return $items->weightedRandom(function (array $item) {
                return $item['weight'];
            });
        })
        ->groupBy('value')
        ->map
        ->count()
        ->sortDesc()
        ->flip()
        ->first();

    expect($mostPopularValue)->toEqual('b');
});

it('will not pick a value without a weight', function () {
    $items = collect([
        ['value' => 'a', 'weight' => 0],
        ['value' => 'b', 'weight' => 0],
        ['value' => 'c', 'weight' => 1],
        ['value' => 'c', 'weight' => 0],
    ]);

    $pickedItem = $items->weightedRandom(fn (array $item) => $item['weight']);

    expect($pickedItem['value'])->toEqual('c');
});

it('will pick a random value when all values are zero', function () {
    $items = collect([
        ['value' => 'a', 'weight' => 0],
        ['value' => 'b', 'weight' => 0],
        ['value' => 'c', 'weight' => 0],
    ]);

    expect($items->weightedRandom(fn (array $item) => $item['weight']))->toBeArray();
});

it('can pick a weighted random by attribute name', function () {
    $items = collect([
        ['value' => 'a', 'weight' => 0],
        ['value' => 'b', 'weight' => 1],
        ['value' => 'c', 'weight' => 0],
    ]);

    $item = ($items->weightedRandom('weight'));

    expect($item['value'])->toEqual('b');
});
