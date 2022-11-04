<?php

use Illuminate\Support\Collection;

it('provides a `fromPairs` macro')
    ->expect(fn () => Collection::hasMacro('fromPairs'))
    ->toBeTrue();

it('can transform a collection into an associative array', function () {
    expect(
        Collection::make([
            ['john@example.com', 'John'],
            ['jane@example.com', 'Jane'],
            ['dave@example.com', 'Dave'],
        ])->fromPairs()->toArray()
    )
        ->toEqual([
            'john@example.com' => 'John',
            'jane@example.com' => 'Jane',
            'dave@example.com' => 'Dave',
        ]);
});
