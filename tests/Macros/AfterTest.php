<?php

use Illuminate\Support\Collection;

it('can retrieve an item that comes after an item', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->after(1))->toEqual(2);
});

it('retrieves items by value and does not reorder them', function () {
    $data = new Collection([
        4 => 3,
        2 => 1,
        1 => 2,
        3 => 4,
    ]);

    expect($data->after(3))->toEqual(1);
});

it('can fix the next item in a collection of strings', function () {
    $data = new Collection([
        'foo' => 'bar',
        'bar' => 'foo',
    ]);

    expect($data->after('bar'))->toEqual('foo');
});

it('can find the next item based on a callback', function () {
    $data = new Collection([3, 1, 2]);

    $result = $data->after(function ($item) {
        return $item > 2;
    });

    expect($result)->toEqual(1);
});

it('returns `null` if there is not a next item', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->after(3))->toBeNull();
});

it('can return a fallback value if there is not a next item', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->after(3, 4))->toEqual(4);
});
