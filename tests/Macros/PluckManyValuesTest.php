<?php


use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestSupport\TestArrayAccessImplementation;

it('provides a pluck many values macro', function () {
    expect(Collection::hasMacro('pluckManyValues'))->toBeTrue();
});

it('can pluck from a collection of collections', function () {
    $data = Collection::make([
        collect(['id' => 1, 'name' => 'matt', 'hobby' => 'coding']),
        collect(['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking']),
    ]);

    expect($data->pluckManyValues(['name', 'hobby']))->toEqual($data->map->only(['name', 'hobby'])->map->values());
});

it('can pluck from array and object items', function () {
    $data = Collection::make([
        (object) ['id' => 1, 'name' => 'matt', 'hobby' => 'coding'],
        ['id' => 2, 'name' => 'tomo', 'hobby' => 'cooking'],
    ]);

    expect($data->pluckManyValues(['name', 'hobby'])->all())->toEqual([
        (object) ['matt', 'coding'],
        ['tomo', 'cooking'],
    ]);
});

it('can pluck from objects that implement array access interface', function () {
    $data = Collection::make([
        new TestArrayAccessImplementation(['id' => 1, 'name' => 'marco', 'hobby' => 'drinking']),
        new TestArrayAccessImplementation(['id' => 2, 'name' => 'belle', 'hobby' => 'cross-stitch']),
    ]);

    expect($data->pluckManyValues(['name', 'hobby'])->all())->toEqual([
        ['marco', 'drinking'],
        ['belle', 'cross-stitch'],
    ]);
});
