<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;

it("can check if an item isn't present in a collection")
    ->expect(fn () => Collection::make(['foo'])->none('bar'))->toBeTrue()
    ->and(fn () => Collection::make(['foo'])->none('foo'))->toBeFalse();

it("can check if a key-value pair isn't present in a collection")
    ->expect(fn () => Collection::make([['name' => 'foo']])->none('name', 'bar'))
    ->toBeTrue()
    ->and(fn () => Collection::make([['name' => 'foo']])->none('name', 'foo'))
    ->toBeFalse();

it("can check if something isn't present in a collection with truth test", function () {
    // Below Laravel 5.3, the callable's parameter order is `$key, $value`.

    if (version_compare(Application::VERSION, '5.3.0', 'lt')) {
        expect(
            Collection::make(['name' => 'foo'])->none(
                fn ($key, $value) => $key === 'name' && $value === 'bar'
            )
        )->toBeTrue();

        expect(
            Collection::make(['name' => 'foo'])->none(
                fn ($key, $value) => $key === 'name' && $value === 'foo'
            )
        )->toBeFalse();

        return;
    }

    // Above Laravel 5.3, the callable's parameter order is `$value, $key`.

    expect(Collection::make(['name' => 'foo'])->none(
        fn ($value, $key) => $key === 'name' && $value === 'bar'
    ))->toBeTrue();

    expect(Collection::make(['name' => 'foo'])->none(
        fn ($value, $key) => $key === 'name' && $value === 'foo'
    ))->toBeFalse();
});
