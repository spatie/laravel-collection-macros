<?php


use Illuminate\Support\Collection;

it('returns array of attributes', function () {
    $result = Collection::make([
        ['id' => 1],
        ['id' => 2],
        ['id' => 3],
    ])->pluckToArray('id');

    $expected = [1, 2, 3];

    expect($result)->toEqual($expected);

    expect($result)->toBeArray();
});

it('return array of attributes with correct keys', function () {
    $result = Collection::make([
        ['id' => 2, 'title' => 'A'],
        ['id' => 3, 'title' => 'B'],
        ['id' => 4, 'title' => 'C'],
    ])->pluckToArray('title', 'id');

    $expected = [2 => 'A', 3 => 'B', 4 => 'C'];

    expect($result)->toEqual($expected);
});
