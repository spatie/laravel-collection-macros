<?php


use Illuminate\Support\Collection;

it('provides an insert before key macro', function () {
    expect(Collection::hasMacro('insertBeforeKey'))->toBeTrue();
});

it('inserts with unkeyed array', function () {
    $collection = Collection::make(['zero', 'two', 'three']);
    $collection->insertBeforeKey(1, 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('returns the updated collection', function () {
    $collection = Collection::make(['zero', 'two', 'three'])->insertBeforeKey(1, 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('maintains array keys', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertBeforeKey('two', 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]));
});

it('inserts with a key', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertBeforeKey('two', 5, 'five');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]));
});
