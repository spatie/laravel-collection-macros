<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ExtractTest extends TestCase
{
    /** @var \Illuminate\Support\Collection */
    private $user = null;

    public function setup(): void
    {
        parent::setUp();

        $this->user = collect([
            'name' => 'Sebastian',
            'company' => 'Spatie',
            'role' => [
                'name' => 'Developer',
            ],
        ]);
    }

    /** @test */
    public function it_provides_an_extract_macro()
    {
        $this->assertTrue(Collection::hasMacro('extract'));
    }

    /** @test */
    public function it_can_extract_a_key()
    {
        $this->assertEquals(['Sebastian'], $this->user->extract('name')->toArray());
    }

    /** @test */
    public function it_can_extract_multiple_keys()
    {
        $this->assertEquals(['Sebastian', 'Spatie'], $this->user->extract('name', 'company')->toArray());
    }

    /** @test */
    public function it_can_extract_multiple_keys_with_an_array()
    {
        $this->assertEquals(['Sebastian', 'Spatie'], $this->user->extract(['name', 'company'])->toArray());
    }

    /** @test */
    public function it_can_extract_nested_keys()
    {
        $this->assertEquals(['Sebastian', 'Developer'], $this->user->extract('name', 'role.name')->toArray());
    }

    /** @test */
    public function it_extracts_null_when_a_keys_doesnt_exist()
    {
        $this->assertEquals([null, 'Sebastian'], $this->user->extract('id', 'name')->toArray());
    }
}
