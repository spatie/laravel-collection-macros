<?php


use Illuminate\Support\Collection;

it('retrieves an item by positive index', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->at(1))->toEqual(2);
});

it('retrieves an item by negative index', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->at(-1))->toEqual(3);
});

it('retrieves an item by zero index', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->at(0))->toEqual(1);
});
