<?php


use Illuminate\Support\Collection;

it('provides rotate macro', function () {
    expect(Collection::hasMacro('rotate'))->toBeTrue();
});

it('can return empty collection if given empty collecton', function () {
    $collection = new Collection([]);
    expect($collection->rotate(2)->toArray())->toHaveCount(0);
});

it('can return same collection if given zero offset', function () {
    $collection = new Collection([1, 2, 3, 4, 5, 6]);
    expect($collection->rotate(0)->toArray())->toEqual([1, 2, 3, 4, 5, 6]);
});

it('can rotate the collection with offset', function () {
    $collection = new Collection([1, 2, 3, 4, 5, 6]);
    expect($collection->rotate(2)->toArray())->toEqual([3, 4, 5, 6, 1, 2]);
});

it('can rotate the collection with negative offset', function () {
    $collection = new Collection([1, 2, 3, 4, 5, 6]);
    expect($collection->rotate(-2)->toArray())->toEqual([5, 6, 1, 2, 3, 4]);
});

it('can rotate the collection with offset with keys', function () {
    $collection = new Collection(['first' => 1, 'second' => 2, 'third' => 3, 'fourth' => 4, 'fifth' => 5]);
    expect($collection->rotate(3)->toArray())->toEqual(['fourth' => 4, 'fifth' => 5, 'first' => 1, 'second' => 2, 'third' => 3]);
});

it('can rotate the collection with nagative offset with keys', function () {
    $collection = new Collection(['first' => 1, 'second' => 2, 'third' => 3, 'fourth' => 4, 'fifth' => 5]);
    expect($collection->rotate(-3)->toArray())->toEqual(['third' => 3, 'fourth' => 4, 'fifth' => 5, 'first' => 1, 'second' => 2]);
});
