<?php


use Illuminate\Support\Collection;

beforeEach(function () {
    $this->user = collect([
        'name' => 'Sebastian',
        'company' => 'Spatie',
        'role' => [
            'name' => 'Developer',
        ],
    ]);
});

it('provides an extract macro', function () {
    expect(Collection::hasMacro('extract'))->toBeTrue();
});

it('can extract a key', function () {
    expect($this->user->extract('name')->toArray())->toEqual(['Sebastian']);
});

it('can extract multiple keys', function () {
    expect($this->user->extract('name', 'company')->toArray())->toEqual(['Sebastian', 'Spatie']);
});

it('can extract multiple keys with an array', function () {
    expect($this->user->extract(['name', 'company'])->toArray())->toEqual(['Sebastian', 'Spatie']);
});

it('can extract nested keys', function () {
    expect($this->user->extract('name', 'role.name')->toArray())->toEqual(['Sebastian', 'Developer']);
});

it('extracts null when a keys doesnt exist', function () {
    expect($this->user->extract('id', 'name')->toArray())->toEqual([null, 'Sebastian']);
});
