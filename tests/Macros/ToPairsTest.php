<?php


use Illuminate\Support\Collection;

it('provides a from pairs macro', function () {
    expect(Collection::hasMacro('fromPairs'))->toBeTrue();
});

it('can transform a collection into an array with pairs', function () {
    expect(Collection::make([
        'john@example.com' => 'John',
        'jane@example.com' => 'Jane',
        'dave@example.com' => 'Dave',
    ])->toPairs()->toArray())->toEqual([
        ['john@example.com', 'John'],
        ['jane@example.com', 'Jane'],
        ['dave@example.com', 'Dave'],
    ]);
});
