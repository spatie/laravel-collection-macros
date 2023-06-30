<?php


use Illuminate\Support\Collection;

it('can retrieve a value if one exists', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->firstOrPush(fn ($item) => $item === 1, 2))->toEqual(1);
});

test('if a value doesnt exist the second argument is pushed in to the collection and returned', function () {
    $data = new Collection([1, 2]);

    expect($data->firstOrPush(fn ($item) => $item === 3, 3))->toEqual(3);
    expect($data->firstOrPush(fn ($item) => $item === 3, 4))->toEqual(3);
});

test('the value parameter can be a callable', function () {
    expect((new Collection())->firstOrPush(fn ($item) => false, fn () => 1))->toEqual(1);
});

test('a collection object can be specified as the push target', function () {
    $data = new Collection([1, 2, 3]);
    $data->filter(fn ($item) => false)->firstOrPush(fn ($item) => false, 4, $data);

    expect($data)->toEqual(new Collection([1, 2, 3, 4]));
});
