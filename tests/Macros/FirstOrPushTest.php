<?php

use Illuminate\Support\Collection;

it('can retrieve a value if one exists', function () {
    $data = new Collection([1, 2, 3]);

    expect($data->firstOrPush(fn ($item) => $item === 1, 2))->toEqual(1);
});

test(
    "if a value doesn't exist the second argument is pushed in to the collection an returned",
    function () {
        $data = new Collection([1, 2]);

        expect([
            $data->firstOrPush(fn ($item) => $item === 3, 3),
            $data->firstOrPush(fn ($item) => $item === 3, 4)
        ])->each->toEqual(3);
    }
);

test('the value parameter can be a callable')
    ->expect(fn () => (new Collection())->firstOrPush(fn ($item) => false, fn () => 1))
    ->toEqual(1);

test('a collection object can be specified as the push target', function () {
    $data = new Collection([1, 2, 3]);
    $data->filter(fn ($item) => false)->firstOrPush(fn ($item) => false, 4, $data);

    expect(new Collection([1, 2, 3, 4]))->toEqual($data);
});
