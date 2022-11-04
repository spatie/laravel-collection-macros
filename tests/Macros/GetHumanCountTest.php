<?php

use Illuminate\Support\Collection;

beforeEach(function () {
    $this->data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);
});

it(
    'gets the nth item of the by collection by method',
    function (string $method, int $value) {
        expect($this->data->$method())->toEqual($value);
    }
)->with([
    'first' => ['first', 1],
    'second' => ['second', 2],
    'third' => ['third', 3],
    'fourth' => ['fourth', 4],
    'fifth' => ['fifth', 5],
    'sixth' => ['sixth', 6],
    'seventh' => ['seventh', 7],
    'eighth' => ['eighth', 8],
    'ninth' => ['ninth', 9],
    'tenth' => ['tenth', 10]
]);

it('gets the nth item of the collection')
    ->expect(fn () => $this->data->getNth(11))
    ->toEqual(11);

it('returns `null` if index is undefined', function () {
    $data = new Collection();

    expect([
        $data->first(),
        $data->second(),
        $data->third(),
        $data->fourth(),
        $data->fifth(),
        $data->sixth(),
        $data->seventh(),
        $data->eighth(),
        $data->ninth(),
        $data->tenth(),
        $data->getNth(11),
    ])->each->toBeNull();
});
