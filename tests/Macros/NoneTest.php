<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;

it('can check if an item isnt present in a collection', function () {
    expect(Collection::make(['foo'])->none('bar'))->toBeTrue();
    expect(Collection::make(['foo'])->none('foo'))->toBeFalse();
});

it('can check if a key value pair isnt present in a collection', function () {
    expect(Collection::make([['name' => 'foo']])->none('name', 'bar'))->toBeTrue();
    expect(Collection::make([['name' => 'foo']])->none('name', 'foo'))->toBeFalse();
});

it('can check if something isnt present in a collection with a truth test', function () {
    // Below Laravel 5.3, the callable's parameter order is `$key, $value`.
    if (version_compare(Application::VERSION, '5.3.0', 'lt')) {
        expect(Collection::make(['name' => 'foo'])->none(function ($key, $value) {
            return $key === 'name' && $value === 'bar';
        }))->toBeTrue();

        expect(Collection::make(['name' => 'foo'])->none(function ($key, $value) {
            return $key === 'name' && $value === 'foo';
        }))->toBeFalse();

        return;
    }

    // Above Laravel 5.3, the callable's parameter order is `$value, $key`.
    expect(Collection::make(['name' => 'foo'])->none(function ($value, $key) {
        return $key === 'name' && $value === 'bar';
    }))->toBeTrue();

    expect(Collection::make(['name' => 'foo'])->none(function ($value, $key) {
        return $key === 'name' && $value === 'foo';
    }))->toBeFalse();
});
