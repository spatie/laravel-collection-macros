<?php


use Illuminate\Support\Collection;

it('returns a collection containing the collected items', function () {
    $collection = new Collection([
        'name' => 'taco',
        'ingredients' => [
            'cheese',
            'lettuce',
            'beef',
            'tortilla',
        ],
        'should_eat' => true,
    ]);

    $ingredients = $collection->collectBy('ingredients');

    expect($ingredients)->toBeInstanceOf(Collection::class);

    expect($ingredients->toArray())->toEqual([
        'cheese',
        'lettuce',
        'beef',
        'tortilla',
    ]);
});

it('returns default when key is missing', function () {
    $collection = new Collection([
        'name' => 'taco',
        'ingredients' => [
            'cheese',
            'lettuce',
            'beef',
            'tortilla',
        ],
        'should_eat' => true,
    ]);

    $ingredients = $collection->collectBy('build_it', $collection->get('ingredients'));

    expect($ingredients)->toEqual($collection->collectBy('ingredients'));
});

it('returns empty collection when missing key without default', function () {
    $collection = new Collection([
        'name' => 'taco',
        'ingredients' => [
            'cheese',
            'lettuce',
            'beef',
            'tortilla',
        ],
        'should_eat' => true,
    ]);

    $ingredients = $collection->collectBy('build_it');

    expect($ingredients)->toEqual(new Collection());
});

it('collects path from collection using dot notation', function () {
    $collection = new Collection([
        'baz.qux' => 'quux',
        'foo' => [
            'bar' => [
                'baz' => 100,
            ],
        ],
    ]);

    expect($collection->collectBy('foo.bar'))->toBeInstanceOf(Collection::class);
    expect($collection->collectBy('foo.bar')->toArray())->toEqual([
        'baz' => 100,
    ]);

    expect($collection->collectBy('baz.qux'))->toBeInstanceOf(Collection::class);
    expect($collection->collectBy('baz.qux')->toArray())->toEqual(['quux']);
});
