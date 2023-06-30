<?php


use Illuminate\Support\Collection;

it('retrieves item from collection', function () {
    $collection = new Collection(['foo', 'bar']);

    expect($collection->path(0))->toBe('foo');
});

it('retrieves item from collection using dot notation', function () {
    $collection = new Collection([
        'foo' => [
            'bar' => [
                'baz' => 100,
            ],
        ],
    ]);

    expect($collection->path('foo.bar.baz'))->toBe(100);
});

it('doesnt remove item from collection', function () {
    $collection = new Collection(['foo', 'bar']);

    $collection->path(0);

    expect($collection->all())->toEqual([
        0 => 'foo',
        1 => 'bar',
    ]);
});

it('returns default', function () {
    $collection = new Collection([]);

    expect($collection->path(0, 'foo'))->toBe('foo');
});
