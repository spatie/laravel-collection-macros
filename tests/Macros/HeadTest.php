<?php

use Illuminate\Support\Collection;

it('provides head macro')
    ->expect(fn () => Collection::hasMacro('head'))
    ->toBeTrue();

it('gets the first item of the collection', function () {
    $data = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    expect($data->head())->toEqual(1);
});

it('returns `null` if the collection is empty', function () {
    $data = new Collection();

    expect($data->head())->toBeNull();
});
