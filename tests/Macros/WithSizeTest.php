<?php


use Illuminate\Support\Collection;

it('can create a collection with the specified size', function () {
    expect(Collection::withSize(1)->toArray())->toEqual([1]);
    expect(Collection::withSize(3)->toArray())->toEqual([1, 2, 3]);
});

it('can creates an empty collection if the given size is lower than one', function () {
    expect(Collection::withSize(0))->toHaveCount(0);
    expect(Collection::withSize(-1))->toHaveCount(0);
});
