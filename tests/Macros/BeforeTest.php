<?php


use Illuminate\Support\Collection;

it('can retrieve an item that comes before an item', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->before(2))->toEqual(1);
});

it('retrieves items by value and doesnt reorder them', function () {
    $data = new Collection([
        4 => 3,
        2 => 1,
        1 => 2,
        3 => 4,
    ]);

    expect($data->before(4))->toEqual(2);
});

it('can find the previous item in a collection of strings', function () {
    $data = new Collection([
        'foo' => 'bar',
        'bar' => 'foo',
    ]);

    expect($data->before('foo'))->toEqual('bar');
});

it('can find the previous item based on a callback', function () {
    $data = new Collection([3, 1, 2]);

    $result = $data->before(function ($item) {
        return $item < 2;
    });

    expect($result)->toEqual(3);
});

it('returns null if there isnt a previous item', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->before(1))->toBeNull();
});
