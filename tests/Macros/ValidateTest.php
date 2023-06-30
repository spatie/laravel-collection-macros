<?php


use Illuminate\Support\Collection;

it('returns true if a collection passes validation with a callback', function () {
    expect(Collection::make(['foo', 'foo'])->validate(function ($item) {
        return $item === 'foo';
    }))->toBeTrue();
});

it('returns false if a collection fails validation with a callback', function () {
    expect(Collection::make(['foo', 'bar'])->validate(function ($item) {
        return $item === 'foo';
    }))->toBeFalse();
});

it('returns true if a collection passes validation with a string', function () {
    expect(Collection::make(['foo', 'bar'])->validate('required'))->toBeTrue();
});

it('returns false if a collection fails validation with a string', function () {
    expect(Collection::make(['foo', ''])->validate('required'))->toBeFalse();
});

it('returns true if a collection passes validation with an array', function () {
    expect(Collection::make([['name' => 'foo'], ['name' => 'bar']])->validate(['name' => 'required']))->toBeTrue();
});

it('returns false if a collection fails validation with an array', function () {
    expect(Collection::make([['name' => 'foo'], ['name' => '']])->validate(['name' => 'required']))->toBeFalse();
});
