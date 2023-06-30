<?php


use Illuminate\Support\Collection;

it('coverts child arrays to collections', function () {
    $collection = Collection::make([
        'child' => [
            1, 2, 3, 'anotherchild' => [1, 2, 3],
        ],
    ])
        ->recursive();

    expect($collection['child'])->toBeInstanceOf(Collection::class);
    expect($collection['child']['anotherchild'])->toBeInstanceOf(Collection::class);
});

it('coverts child objects to collections', function () {
    $collection = Collection::make([
        'child' => (object) [1, 2, 3, 'anotherchild' => (object) [1, 2, 3]],
    ])
        ->recursive();

    expect($collection['child'])->toBeInstanceOf(Collection::class);
    expect($collection['child']['anotherchild'])->toBeInstanceOf(Collection::class);
});

it('coverts child arrays to collections with a max depth', function () {
    $collection = Collection::make([
        'child' => [
            1, 2, 3, 'anotherchild' => [
                1, 2, 3, 'lastchild' => [1, 2, 3],
            ],
        ],
    ])
        ->recursive(1);

    expect($collection['child'])->toBeInstanceOf(Collection::class);
    expect($collection['child']['anotherchild'])->toBeInstanceOf(Collection::class);
    expect($collection['child']['anotherchild']['lastchild'])->toBeArray();
});
