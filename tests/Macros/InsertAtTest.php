<?php


use Illuminate\Support\Collection;

it('provides an insert at macro', function () {
    expect(Collection::hasMacro('insertAt'))->toBeTrue();
});

it('inserts at the correct index', function () {
    $collection = Collection::make(['zero', 'two', 'three']);
    $collection->insertAt(1, 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('returns the updated collection', function () {
    $collection = Collection::make(['zero', 'two', 'three'])->insertAt(1, 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('maintains array keys', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAt(1, 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]));
});

it('inserts with a key', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAt(1, 5, 'five');

    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]));
});
