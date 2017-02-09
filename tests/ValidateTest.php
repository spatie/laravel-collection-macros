<?php

namespace Spatie\CollectionMacros\Test;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Support\Collection;

class ValidateTest extends OrchestraTestCase
{
    public function setUp()
    {
        parent::setUp();

        require_once __DIR__.'/../src/macros.php';
    }

    /** @test */
    public function it_returns_true_if_a_collection_passes_validation_with_a_callback()
    {
        $this->assertTrue(Collection::make(['foo', 'foo'])->validate(function ($item) {
            return $item === 'foo';
        }));
    }

    /** @test */
    public function it_returns_false_if_a_collection_fails_validation_with_a_callback()
    {
        $this->assertFalse(Collection::make(['foo', 'bar'])->validate(function ($item) {
            return $item === 'foo';
        }));
    }

    /** @test */
    public function it_returns_true_if_a_collection_passes_validation_with_a_string()
    {
        $this->assertTrue(Collection::make(['foo', 'bar'])->validate('required'));
    }

    /** @test */
    public function it_returns_false_if_a_collection_fails_validation_with_a_string()
    {
        $this->assertFalse(Collection::make(['foo', ''])->validate('required'));
    }

    /** @test */
    public function it_returns_true_if_a_collection_passes_validation_with_an_array()
    {
        $this->assertTrue(Collection::make([['name' => 'foo'], ['name' => 'bar']])->validate(['name' => 'required']));
    }

    /** @test */
    public function it_returns_false_if_a_collection_fails_validation_with_an_array()
    {
        $this->assertFalse(Collection::make([['name' => 'foo'], ['name' => '']])->validate(['name' => 'required']));
    }
}
