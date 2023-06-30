<?php


use Illuminate\Support\Collection;

it('provides an insert after macro', function () {
    expect(Collection::hasMacro('insertAfter'))->toBeTrue();
});

it('inserts at the correct index', function () {
    $collection = Collection::make(['zero', 'two', 'three']);
    $collection->insertAfter('zero', 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('returns the updated collection', function () {
    $collection = Collection::make(['zero', 'two', 'three'])->insertAfter('zero', 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero', 'one', 'two', 'three']));
});

it('maintains array keys', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfter(0, 'one');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero' => 0, 'one', 'two' => 2, 'three' => 3]));
});

it('inserts with a key', function () {
    $collection = Collection::make(['zero' => 0, 'two' => 2, 'three' => 3])->insertAfter(0, 5, 'five');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['zero' => 0, 'five' => 5, 'two' => 2, 'three' => 3]));
});

it('inserts at the end of the array', function () {
    $collection = Collection::make(['one', 'two'])->insertAfter('two', 'three');
    expect(json_encode($collection->toArray()))->toEqual(json_encode(['one', 'two', 'three']));
});
