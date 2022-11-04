<?php

use Illuminate\Support\Collection;

it('provides an `insertAfterKey` macro')
    ->expect(fn () => Collection::hasMacro('insertAfterKey'))
    ->toBeTrue();

it('interacts with unkeyed array', function () {
    $collection = Collection::make(['zero', 'two', 'three']);
    $collection->insertAfterKey(0, 'one');

    expect(json_encode($collection->toArray()))
        ->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('returns the updated collection', function () {
    $collection = Collection::make(['zero', 'two', 'three'])->insertAfterKey(0, 'one');

    expect(json_encode($collection->toArray()))
        ->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('maintains array keys', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfterKey('zero', 'one');

    expect(json_encode($collection->toArray()))
        ->toEqual(json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]));
});

it('inserts with a key', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfterKey('zero', 5, 'five');

    expect(json_encode($collection->toArray()))
        ->toEqual(json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]));
});

it('inserts at the end of the array', function () {
    $collection = Collection::make(['one', 'two'])->insertAfterKey(1, 'three');

    expect(json_encode($collection->toArray()))
        ->toEqual(json_encode(['one', 'two', 'three']));
});
