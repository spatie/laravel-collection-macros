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

it('can pluck dot-notated keys from a collection of collections', function () {
    $data = Collection::make([
        collect(['id' => 1, 'name' => 'matt', 'info' => ['hobby' => 'coding']]),
        collect(['id' => 2, 'name' => 'tomo', 'info' => ['hobby' => 'cooking']]),
    ]);

    expect($data->pluckMany(['name', 'info.hobby']))->toEqual(collect([
        collect(['name' => 'matt', 'info.hobby' => 'coding']),
        collect(['name' => 'tomo', 'info.hobby' => 'cooking'])
    ]));
});

it('can pluck dot-notated keys from array and object items', function () {
    $data = Collection::make([
        (object) ['id' => 1, 'name' => 'matt', 'info' => ['hobby' => 'coding']],
        ['id' => 2, 'name' => 'tomo', 'info' => ['hobby' => 'cooking']],
    ]);

    expect($data->pluckMany(['name', 'info.hobby'])->all())->toEqual([
        (object) ['name' => 'matt', 'info.hobby' => 'coding'],
        ['name' => 'tomo', 'info.hobby' => 'cooking'],
    ]);
});

it('can pluck dot-notated keys from objects that implement array access interface', function () {
    $data = Collection::make([
        new TestArrayAccessImplementation(['id' => 1, 'name' => 'marco', 'info' => ['hobby' => 'drinking']]),
        new TestArrayAccessImplementation(['id' => 2, 'name' => 'belle', 'info' => ['hobby' => 'cross-stitch']]),
    ]);

    expect($data->pluckMany(['name', 'info.hobby'])->all())->toEqual([
        ['name' => 'marco', 'info.hobby' => 'drinking'],
        ['name' => 'belle', 'info.hobby' => 'cross-stitch'],
    ]);
});
