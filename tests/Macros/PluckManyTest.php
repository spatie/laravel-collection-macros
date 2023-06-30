<?php


use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestSupport\TestArrayAccessImplementation;

it('provides a pluck many macro', function () {
    expect(Collection::hasMacro('pluckMany'))->toBeTrue();
});

it('can pluck from a collection of collections', function () {
    $data = Collection::make([
        collect(['id' => 1, 'name' => 'matt', 'hobby' => 'coding']),
        collect(['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking']),
    ]);

    expect($data->pluckMany(['name', 'hobby']))->toEqual($data->map->only(['name', 'hobby']));
});

it('can pluck from array and object items', function () {
    $data = Collection::make([
        (object) ['id' => 1, 'name' => 'matt', 'hobby' => 'coding'],
        ['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking'],
    ]);

    expect($data->pluckMany(['name', 'hobby'])->all())->toEqual([
        (object) ['name' => 'matt', 'hobby' => 'coding'],
        ['name' => 'tomo', 'hobby' => 'cooking'],
    ]);
});

it('can pluck from objects that implement array access interface', function () {
    $data = Collection::make([
        new TestArrayAccessImplementation(['id' => 1, 'name' => 'marco', 'hobby' => 'drinking']),
        new TestArrayAccessImplementation(['id' => 2, 'name' => 'belle', 'hobby' => 'cross-stitch']),
    ]);

    expect($data->pluckMany(['name', 'hobby'])->all())->toEqual([
        ['name' => 'marco', 'hobby' => 'drinking'],
        ['name' => 'belle', 'hobby' => 'cross-stitch'],
    ]);
});
