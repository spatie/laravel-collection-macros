<?php


use Illuminate\Support\Collection;

it('gets the first item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->first())->toEqual(1);
});

it('gets the second item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->second())->toEqual(2);
});

it('gets the third item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->third())->toEqual(3);
});

it('gets the fourth item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->fourth())->toEqual(4);
});

it('gets the fifth item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->fifth())->toEqual(5);
});

it('gets the sixth item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->sixth())->toEqual(6);
});

it('gets the seventh item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->seventh())->toEqual(7);
});

it('gets the eighth item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->eighth())->toEqual(8);
});

it('gets the ninth item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->ninth())->toEqual(9);
});

it('gets the tenth item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->tenth())->toEqual(10);
});

it('gets the nth item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);

    expect($data->getNth(11))->toEqual(11);
});

it('returns null if index is undefined', function () {
    $data = new Collection();

    expect($data->first())->toBeNull();
    expect($data->second())->toBeNull();
    expect($data->third())->toBeNull();
    expect($data->fourth())->toBeNull();
    expect($data->fifth())->toBeNull();
    expect($data->sixth())->toBeNull();
    expect($data->seventh())->toBeNull();
    expect($data->eighth())->toBeNull();
    expect($data->ninth())->toBeNull();
    expect($data->tenth())->toBeNull();
    expect($data->getNth(11))->toBeNull();
});
