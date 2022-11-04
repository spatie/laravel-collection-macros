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

it('provides an extract macro')
    ->expect(fn () => Collection::hasMacro('extract'))
    ->toBeTrue();

it('can extract a key')
    ->expect(fn () => $this->user->extract('name')->toArray())
    ->toEqual(['Sebastian']);

it('can extract multiple keys')
    ->expect(fn () => $this->user->extract('name', 'company')->toArray())
    ->toEqual(['Sebastian', 'Spatie']);

it('can extract multiple keys with an array')
    ->expect(fn () => $this->user->extract(['name', 'company'])->toArray())
    ->toEqual(['Sebastian', 'Spatie']);

it('can extract nested keys')
    ->expect(fn () => $this->user->extract('name', 'role.name')->toArray())
    ->toEqual(['Sebastian', 'Developer']);

it("extracts `null` when a key doesn't exist")
    ->expect(fn () => $this->user->extract('id', 'name')->toArray())
    ->toEqual([null, 'Sebastian']);
